// --- seu código original (mantido) ---
function toggleMenu() {
  const menu = document.getElementById("floating-menu");
  menu.classList.toggle("active");
}

// --- NOVO SCRIPT SPA À PROVA DE CONFLITO ---
document.addEventListener("DOMContentLoaded", () => {
  // Seleciona todos os links relevantes (menu principal, flutuante e logo)
  // inclui também o link do carrinho (classe/cart-icon) para tratar como seção 'cart'
  const links = Array.from(document.querySelectorAll('.cart-icon a, #cart-icon a, nav.main-menu a, #floating-menu a, .logo a'));

  // Todas as seções principais (inclui index)
  const sections = Array.from(document.querySelectorAll('.content-section'));

  // Função que mostra apenas a seção .content-section com o id fornecido
  function mostrarSecao(id) {
    if (!id) return;
    const target = document.querySelector('.content-section#' + id);
    if (!target) return; // evita selecionar elementos errados por id duplicado

    sections.forEach(sec => {
      if (sec === target) {
        sec.classList.remove('hidden');
        sec.classList.add('active-section');
      } else {
        sec.classList.add('hidden');
        sec.classList.remove('active-section');
      }
    });
    // Se abrimos a seção do carrinho, avise o Cart.js para renderizar o conteúdo
    if (id === 'cart' && typeof window !== 'undefined') {
      // dispare um evento customizado para não acoplar módulos
      const ev = new Event('cart:shown');
      document.dispatchEvent(ev);
    }
  }

  // Função utilitária para extrair target do link
  function inferirTargetFromLink(link) {
    // Prefer data-target (explicit)
    if (link.dataset && link.dataset.target) return link.dataset.target;
    // Caso contrário, use o fragmento do href (#xbox)
    const href = (link.getAttribute('href') || '').trim();
    // Se o href referencia o arquivo Cart.php, mapeamos para a seção 'cart'
    if (/cart\.php$/i.test(href) || /\/cart(\.php)?$/i.test(href)) return 'cart';
    if (href.startsWith('#')) return href.replace('#', '').toLowerCase();
    // Fallback: use parent li class (link1, link2, link3)
    const li = link.closest('li');
    if (li && li.classList.length) {
      const cls = li.classList[0];
      if (cls === 'link1') return 'xbox';
      if (cls === 'link2') return 'nintendo';
      if (cls === 'link3') return 'playstation';
    }
    return null;
  }

  // Eventos de clique para todos os links relevantes
  links.forEach(link => {
    link.addEventListener('click', (e) => {
      try {
        const targetId = inferirTargetFromLink(link);
        if (!targetId) return; // deixa link navegar se não for um target reconhecido
        e.preventDefault();
        mostrarSecao(targetId);
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Fecha menu flutuante se estiver aberto
        const floatingMenu = document.getElementById('floating-menu');
        if (floatingMenu && floatingMenu.classList.contains('active')) {
          floatingMenu.classList.remove('active');
        }
      } catch (err) {
        console.error('[SPA] erro no handler de clique:', err);
      }
    });
  });

  // Delegation: em alguns templates os anchors podem ter estrutura diferente; garante captura de cliques no menu
  const mainMenu = document.querySelector('nav.main-menu');
  if (mainMenu) {
    mainMenu.addEventListener('click', (e) => {
      const a = e.target.closest('a');
      if (!a) return;
      try {
        const targetId = inferirTargetFromLink(a);
        if (!targetId) return;
        e.preventDefault();
        mostrarSecao(targetId);
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } catch (err) {
        console.error('[SPA][delegation] erro:', err);
      }
    });
  }

  // Inicializa: se houver hash válido na URL, mostra essa seção; caso contrário, mostra index
  const initialHash = (window.location.hash || '').replace('#', '').toLowerCase();
  if (initialHash && document.querySelector('.content-section#' + initialHash)) {
    mostrarSecao(initialHash);
  } else {
    mostrarSecao('index');
  }
});


