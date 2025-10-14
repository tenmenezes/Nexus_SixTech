<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Configurações do Usuário</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      transition: background-color 0.3s, color 0.3s;
      background-color: #e5e5e5;
    }

    .container {
      max-width: 400px;
      margin: auto;
      background: rgba(197, 196, 196, 0.54);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 2px 5px #cccccc80;
      transition: background-color 0.3s, color 0.3s;
    }

    h2 {
      text-align: center;
    }

    p, label {
      margin: 10px 0;
    }

    body.dark-mode, .container.dark-mode {
      background-color: #121212;
      color: #f1f1f1;
    }

    .large-font {
      font-size: 1.2em;
    }

    .small-font {
      font-size: 0.8em;
    }

    .settings {
      margin-top: auto;
      padding-top: auto;
    }

    select {
      width: 50%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
    }

    .user-actions-btns {
      display: flex;
      justify-content: space-around;
      gap: 10px;
      margin: 20px 0;
    }
    .user-actions-btns a {
      text-decoration: none;
    }
    .user-actions-btns button {
      width: 120px;
      background: #28a745;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 0;
      font-size: 0.8em;
      cursor: pointer;
      transition: background 0.2s;
    }
    .user-actions-btns button:hover {
      background: #218838;
    }

    @media (max-width: 468px) {
      .user-actions-btns button {
        width: 80px;
      }

    }

    @media (max-width: 338px) {
      .user-actions-btns button {
        width: 60px;
      }
    }

  </style>
</head>
<body>
  <div class="container" id="config-container">
    <h2>Dados do Usuário</h2>
    <p><strong>Usuário:</strong> <span id="username"></span></p>
    <p><strong>E-mail:</strong> <span id="email"></span></p>
    <p><strong>Senha:</strong> <span id="senha"></span></p>
    <div id="user-actions"></div>
    <hr>
    <div class="settings">
      <h2>Acessibilidade</h2>
    <hr>
    
    <br><label for="theme-select">Tema:</label>
    <select id="theme-select">
      <option value="light">Claro</option>
      <option value="dark">Escuro</option>
    </select>
    
    <br><br><label for="font-select">Fonte:</label>
      <select id="font-select">
        <option value="small">Pequena</option>
        <option value="normal">Normal</option>
        <option value="large">Grande</option>
      </select>
      <div class="user-actions-btns">
        <!-- Botão para voltar -->
       <a href="javascript:history.back()" class="settings"><button onclick="location.reload()">⬅ Voltar</button>
      </div>
    </div>
  </div>

  <script>
    // Busca usuário do localStorage
    const user = JSON.parse(localStorage.getItem('usuarioLogado'));
    const userView = sessionStorage.getItem('userView');
    const usernameSpan = document.getElementById('username');
    const emailSpan = document.getElementById('email');
    const senhaSpan = document.getElementById('senha');
    const actionsDiv = document.getElementById('user-actions');

    if (userView === 'not-logged' || !user) {
      usernameSpan.textContent = "nome não encontrado";
      emailSpan.textContent = "email não encontrado";
      senhaSpan.textContent = "senha não encontrada";
      actionsDiv.innerHTML = `
        <div class="user-actions-btns">
          <a href="../Cadastro/cadastro.html"><button type="button">Realizar cadastro</button></a>
          <a href="#"><button type="button">Logar</button></a>
        </div>
      `;
    } else {
      usernameSpan.textContent = user.usuario || '';
      emailSpan.textContent = user.email || '';
      senhaSpan.textContent = user.senha || '';
      actionsDiv.innerHTML = `
        <div class="user-actions-btns">
          <a href="../Login/forgotPassword/forgotPassword.html"><button type="button">Trocar senha</button></a>
          <button type="button" id="btnLogout">Logout</button>
        </div>
      `;

      const btn = document.getElementById("btnLogout").addEventListener('click', function(){

        localStorage.removeItem('usuarioLogado'); //removendo apenas o usuario logado
        window.location.href = '../HomePage/HomePage.html';

      });

    }

    // Preferências de tema e fonte
    const body = document.body;
    const container = document.getElementById('config-container');
    const themeSelect = document.getElementById('theme-select');
    const fontSelect = document.getElementById('font-select');

    // Aplica preferências salvas
    const savedTheme = localStorage.getItem('user-theme') || 'light';
    const savedFontSize = localStorage.getItem('user-font') || 'normal';

    themeSelect.value = savedTheme;
    fontSelect.value = savedFontSize;

    applyTheme(savedTheme);
    applyFontSize(savedFontSize);

    themeSelect.addEventListener('change', () => {
      const theme = themeSelect.value;
      applyTheme(theme);
      localStorage.setItem('user-theme', theme);
    });

    fontSelect.addEventListener('change', () => {
      const font = fontSelect.value;
      applyFontSize(font);
      localStorage.setItem('user-font', font);
    });

    function applyTheme(theme) {
      if (theme === 'dark') {
        body.classList.add('dark-mode');
        container.classList.add('dark-mode');
      } else {
        body.classList.remove('dark-mode');
        container.classList.remove('dark-mode');
      }
    }

    function applyFontSize(size) {
      body.classList.remove('large-font', 'small-font');
      container.classList.remove('large-font', 'small-font');
      if (size === 'large') {
        body.classList.add('large-font');
        container.classList.add('large-font');
      } else if (size === 'small') {
        body.classList.add('small-font');
        container.classList.add('small-font');
      }
      // normal: nenhuma classe extra
    }
  </script>
</body>
</html>
