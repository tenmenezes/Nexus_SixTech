// Adiciona ao carrinho e atualiza o contador
function atualizarCartCount() {
  const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
  const cartCount = document.getElementById('cart-count');
  if (cartCount) cartCount.textContent = carrinho.length;
}

function adicionarAoCarrinho(event) {
  const btn = event.target;
  const productCard = btn.closest('.product-card');
  if (!productCard) return;
  const img = productCard.querySelector('#imagem');
  const nome = productCard.querySelector('#nome');
  const preco = productCard.querySelector('#preco');
  if (!img || !nome || !preco) return;
  const item = {
    imagem: img.getAttribute('src'),
    nome: nome.textContent,
    preco: preco.textContent
  };
  let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
  carrinho.push(item);
  localStorage.setItem('carrinho', JSON.stringify(carrinho));
  atualizarCartCount();
}

// Função para exibir os itens do carrinho na página do carrinho
function exibirCarrinhoNaPagina() {
  const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
  const grid = document.getElementById('product-grid');
  if (!grid) return;
  // Limpa o conteúdo, mas mantém o título
  grid.innerHTML = ''; // Limpa o grid antes de adicionar os itens
  if (carrinho.length === 0) {
    grid.innerHTML = '<div class="carrinho-vazio">Carrinho vazio</div>';
    return;
  }
  carrinho.forEach((item, index) => {
    const card = document.createElement('div');
    card.className = 'product-card';
    card.innerHTML = `
      <img id="imagem" src="${item.imagem}" alt="${item.nome}">
      <div class="product-info">
        <h3 id="nome">${item.nome}</h3>
        <p id="preco" class="price">${item.preco}</p>
        <button class="remove-btn" onclick="removerDoCarrinho(${index})">Remover</button>
      </div>
    `;
    grid.appendChild(card);
  });
}

// Função para remover item do carrinho
function removerDoCarrinho(index) {
  let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
  carrinho.splice(index, 1);
  localStorage.setItem('carrinho', JSON.stringify(carrinho));
  exibirCarrinhoNaPagina();
  atualizarCartCount();
}

document.addEventListener('DOMContentLoaded', function() {
  atualizarCartCount();
  const grid = document.getElementById('product-grid');
  // Se estiver na página do carrinho, exibe os itens do carrinho
  if (grid && window.location.pathname.includes('Cart.html')) {
    exibirCarrinhoNaPagina();
  } else {
    // Se estiver em uma página de produtos, adiciona evento aos botões
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
      btn.addEventListener('click', adicionarAoCarrinho);
    });
  }
});

document.addEventListener('DOMContentLoaded', () => {
    const btnFinalizar = document.querySelector('.finalizar'); // primeiro botão "Finalizar Compra"

    if (btnFinalizar) {
      btnFinalizar.addEventListener('click', () => {
        const usuarioLogado = localStorage.getItem('usuarioLogado'); // Ex: pode ser um nome, ID ou token

        if (!usuarioLogado) {
          alert("⚠️ Você precisa estar logado para finalizar a compra!");
          return;
        }

        // Se estiver logado:
        alert("✅ Compra finalizada com sucesso! Obrigado pela preferência.");
        localStorage.removeItem('carrinho');
        exibirCarrinhoNaPagina(); // Atualiza a exibição na tela imediatamente
        atualizarCartCount();     // Zera o contador do carrinho
      });
    }
  });