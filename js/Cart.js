// Adiciona ao carrinho e atualiza o contador
function atualizarCartCount() {
  const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
  const cartCount = document.getElementById("cart-count");
  if (cartCount) cartCount.textContent = carrinho.length;
}

function adicionarAoCarrinho(eOrBtn) {
  // Aceita ser chamado tanto por addEventListener (recebe event) quanto inline onclick (sem args)
  let btn;
  if (eOrBtn && eOrBtn.target) {
    btn = eOrBtn.target;
  } else if (eOrBtn && eOrBtn.nodeType) {
    btn = eOrBtn;
  } else {
    // Tenta usar document.activeElement como fallback (quando chamado inline)
    btn = document.activeElement;
  }
  if (!btn) return;
  const productCard = btn.closest(".product-card");
  if (!productCard) return;
  // Suporta tanto ids antigos quanto classes novas: #imagem ou .imagem
  const img = productCard.querySelector("#imagem, .imagem");
  const nome = productCard.querySelector("#nome, .nome");
  const preco = productCard.querySelector("#preco, .price");
  if (!img || !nome || !preco) return;
  const item = {
    imagem: img.getAttribute("src"),
    nome: nome.textContent,
    preco: preco.textContent,
  };
  let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
  carrinho.push(item);
  localStorage.setItem("carrinho", JSON.stringify(carrinho));
  atualizarCartCount();
}

// Função para exibir os itens do carrinho na página do carrinho
function exibirCarrinhoNaPagina() {
  const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
  const grid = document.getElementById("product-grid");
  if (!grid) return;
  // Limpa o conteúdo, mas mantém o título
  grid.innerHTML = ""; // Limpa o grid antes de adicionar os itens
  if (carrinho.length === 0) {
    grid.innerHTML = '<div class="carrinho-vazio">Carrinho vazio</div>';
    return;
  }
  carrinho.forEach((item, index) => {
    const card = document.createElement("div");
    card.className = "product-card";
    card.innerHTML = `
      <img class="imagem" src="${item.imagem}" alt="${item.nome}">
      <div class="product-info">
        <h3 class="nome">${item.nome}</h3>
        <p class="price">${item.preco}</p>
        <button class="remove-btn" onclick="removerDoCarrinho(${index})">Remover</button>
      </div>
    `;
    grid.appendChild(card);
  });
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

document.addEventListener("DOMContentLoaded", () => {
  const btnFinalizar = document.querySelector(".finalizar");

  if (btnFinalizar) {
    btnFinalizar.addEventListener("click", () => {
      // Verifica primeiro no localStorage (fluxo SPA)
      let usuarioLogado = localStorage.getItem("usuarioLogado");
      // Se não houver, tenta ler o elemento impresso pelo servidor (id="user-name")
      if (!usuarioLogado) {
        const userEl = document.getElementById('user-name');
        if (userEl) usuarioLogado = userEl.textContent && userEl.textContent.trim();
      }

      if (!usuarioLogado) {
        alert("⚠️ Você precisa estar logado para finalizar a compra!");
        return;
      }

      alert("✅ Compra finalizada com sucesso! Obrigado pela preferência.");
      localStorage.removeItem("carrinho");
      exibirCarrinhoNaPagina();
      atualizarCartCount();
    });
  }
});

// Quando a SPA mostra a seção do carrinho, o homePage.js dispara um evento 'cart:shown'.
// Escute e exiba o carrinho quando solicitado.
document.addEventListener('cart:shown', () => {
  const grid = document.getElementById('product-grid');
  if (grid) exibirCarrinhoNaPagina();
});

