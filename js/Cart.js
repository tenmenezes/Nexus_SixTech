// Adiciona ao carrinho e atualiza o contador
function atualizarCartCount() {
  const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
  const cartCount = document.getElementById("cart-count");
  if (cartCount) cartCount.textContent = carrinho.length;
}

function adicionarAoCarrinho(gameId) {
  // Aceita o ID do jogo como parâmetro
  if (typeof gameId === 'object' && gameId.target) {
    // Se foi chamado por event listener, pega o botão
    const btn = gameId.target;
    const productCard = btn.closest(".product-card");
    if (!productCard) return;
    
    // Extrai o ID do atributo data ou do onclick
    const onclickAttr = btn.getAttribute('onclick');
    if (onclickAttr) {
      const match = onclickAttr.match(/\d+/);
      if (match) gameId = parseInt(match[0]);
    }
  }
  
  // Busca o card do produto pelo ID do jogo
  const productCard = document.querySelector(`[data-game-id="${gameId}"]`) || 
                       document.querySelector(`.product-card button[onclick*="${gameId}"]`)?.closest('.product-card');
  
  if (!productCard) return;
  
  // Suporta tanto ids antigos quanto classes novas
  const img = productCard.querySelector("#imagem, .imagem");
  const nome = productCard.querySelector("#nome, .nome");
  const preco = productCard.querySelector("#preco, .price");
  
  if (!img || !nome || !preco) return;
  
  // Extrai o valor numérico do preço
  const precoText = preco.textContent.replace(/[^\d,]/g, '');
  const precoNumerico = parseFloat(precoText.replace(',', '.'));
  
  const item = {
    game_id: gameId,
    imagem: img.getAttribute("src"),
    nome: nome.textContent.trim(),
    preco: precoText,
    preco_numerico: precoNumerico,
    quantidade: 1
  };
  
  let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
  
  // Verifica se o item já existe no carrinho
  const itemExistente = carrinho.find(i => i.game_id === gameId);
  if (itemExistente) {
    itemExistente.quantidade++;
  } else {
    carrinho.push(item);
  }
  
  localStorage.setItem("carrinho", JSON.stringify(carrinho));
  atualizarCartCount();
}

// Função para exibir os itens do carrinho na página do carrinho
function exibirCarrinhoNaPagina() {
  const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
  const grid = document.getElementById("product-grid");
  if (!grid) return;
  
  grid.innerHTML = "";
  
  if (carrinho.length === 0) {
    grid.innerHTML = '<div class="carrinho-vazio">Carrinho vazio</div>';
    return;
  }
  
  let totalGeral = 0;
  
  carrinho.forEach((item, index) => {
    const subtotal = item.preco_numerico * item.quantidade;
    totalGeral += subtotal;
    
    const card = document.createElement("div");
    card.className = "product-card";
    card.innerHTML = `
      <img class="imagem" src="${item.imagem}" alt="${item.nome}">
      <div class="product-info">
        <h3 class="nome">${item.nome}</h3>
        <p class="price">R$ ${item.preco}</p>
        <div class="quantidade-control">
          <button class="qty-btn" onclick="alterarQuantidade(${index}, -1)">-</button>
          <span class="quantidade">${item.quantidade}</span>
          <button class="qty-btn" onclick="alterarQuantidade(${index}, 1)">+</button>
        </div>
        <p class="subtotal">Subtotal: R$ ${subtotal.toFixed(2).replace('.', ',')}</p>
        <button class="remove-btn" onclick="removerDoCarrinho(${index})">Remover</button>
      </div>
    `;
    grid.appendChild(card);
  });
  
  // Adiciona o total geral
  const totalDiv = document.createElement("div");
  totalDiv.className = "total-carrinho";
  totalDiv.innerHTML = `<h3>Total: R$ ${totalGeral.toFixed(2).replace('.', ',')}</h3>`;
  grid.appendChild(totalDiv);
}

// Função para alterar quantidade
function alterarQuantidade(index, delta) {
  let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
  
  if (carrinho[index]) {
    carrinho[index].quantidade += delta;
    
    if (carrinho[index].quantidade <= 0) {
      carrinho.splice(index, 1);
    }
    
    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    exibirCarrinhoNaPagina();
    atualizarCartCount();
  }
}

// Função para remover item do carrinho
function removerDoCarrinho(index) {
  let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
  carrinho.splice(index, 1);
  localStorage.setItem("carrinho", JSON.stringify(carrinho));
  exibirCarrinhoNaPagina();
  atualizarCartCount();
}

document.addEventListener("DOMContentLoaded", function () {
  atualizarCartCount();
  const grid = document.getElementById("product-grid");
  
  // Se estivermos numa página dedicada Cart.php ou se a seção SPA #cart estiver ativa na página, exibe os itens
  if (grid && (/Cart\.php$/i.test(window.location.pathname) || document.querySelector('.content-section#cart.active-section'))) {
    exibirCarrinhoNaPagina();
  } else {
    // Se estiver em uma página de produtos, adiciona evento aos botões
    // Evita adicionar um listener se já houver um onclick inline (para não duplicar a ação)
    document.querySelectorAll(".add-to-cart-btn").forEach((btn) => {
      if (!btn.getAttribute('onclick')) {
        btn.addEventListener("click", adicionarAoCarrinho);
      }
    });
  }
});

// Função para finalizar compra
async function finalizarCompra() {
  console.log('Finalizando compra...');
  const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
  console.log('Carrinho:', carrinho);
  
  if (carrinho.length === 0) {
    alert("⚠️ Seu carrinho está vazio!");
    return;
  }

  // Prepara os dados para enviar ao servidor
  const itens = carrinho.map(item => ({
    game_id: item.game_id,
    quantidade: item.quantidade
  }));

  console.log('Itens a enviar:', itens);

  try {
    console.log('Enviando requisição...');
    const response = await fetch('./finalizar_compra.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ itens })
    });

    console.log('Status da resposta:', response.status);
    const result = await response.json();
    console.log('Resultado:', result);

    if (result.success) {
      alert(`✅ ${result.message}\n\nPedido #${result.order_id}\nValor Total: R$ ${result.valor_total}`);
      localStorage.removeItem("carrinho");
      exibirCarrinhoNaPagina();
      atualizarCartCount();
    } else {
      alert(`❌ Erro ao finalizar compra: ${result.error}`);
    }
  } catch (error) {
    console.error('Erro:', error);
    alert("❌ Erro ao processar a compra. Tente novamente.");
  }
}

// Usa delegação de eventos para capturar cliques no botão mesmo quando criado dinamicamente
document.addEventListener("click", (e) => {
  if (e.target.classList.contains("btn-finalizar") || e.target.closest(".btn-finalizar")) {
    console.log('Botão finalizar clicado via delegação!');
    e.preventDefault();
    e.stopImmediatePropagation(); // Previne múltiplas execuções
    finalizarCompra();
  }
});

// Quando a SPA mostra a seção do carrinho, o homePage.js dispara um evento 'cart:shown'.
// Escute e exiba o carrinho quando solicitado.
document.addEventListener('cart:shown', () => {
  console.log('Evento cart:shown recebido');
  const grid = document.getElementById('product-grid');
  if (grid) {
    console.log('Exibindo carrinho...');
    exibirCarrinhoNaPagina();
  }
});

