document.addEventListener("DOMContentLoaded", () => {
    const tableInput = document.getElementById("tableName");
    const links = document.querySelectorAll('.sidebar a');
    const sections = document.querySelectorAll('.content-section');

    // Mostrar seção correta
    function mostrarSecao(id) {
        sections.forEach(sec => {
            if (sec.id === id) {
                sec.classList.remove('hidden');
                sec.classList.add('active-section');
            } else {
                sec.classList.add('hidden');
                sec.classList.remove('active-section');
            }
        });
    }

    // Atualiza o input tableName de acordo com o hash
    function atualizarTableName() {
        let hash = window.location.hash.replace('#', '') || "users";

        // Define o nome da tabela no backend
        let tableName = '';
        if (hash === 'users') tableName = 'users';
        else if (hash === 'games') tableName = 'games';
        else if (hash === 'orders') tableName = 'orders';
        else if (hash === 'session_logs') tableName = 'session_logs';

        tableInput.value = tableName;

        // Carrega dados quando houver tabela definida
        if (tableName && typeof loadDataForSection === 'function') {
            setTimeout(() => loadDataForSection(hash), 50);
        }
    }

    // Clique nos links da sidebar
    links.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (!href.startsWith('#')) return;

            e.preventDefault();
            const id = href.replace('#', '').toLowerCase();

            mostrarSecao(id);
            window.location.hash = id; // garante sincronização do hash
            atualizarTableName();
        });
    });

    // Quando a página carrega
    const initialHash = window.location.hash.replace('#', '') || 'users';

    mostrarSecao(initialHash.toLowerCase());
    atualizarTableName();

    // Reage a mudanças do hash
    window.addEventListener('hashchange', atualizarTableName);
});
