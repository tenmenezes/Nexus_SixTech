#

<table border="0">
  <tr>
    <td>
      <img src="utils/img/imgProject-removebg-preview.png" alt="Logo" width="600"/>
    </td>
    <td>
      <h2 align="center">Bem-vindo ao <strong>Nexus SixTech</strong></h2>
      <h3>
        Um projeto de site de vendas e cadastro de jogos digitais.<br>
        O objetivo é construir uma plataforma responsiva, moderna e funcional, que permita o 
        <strong>cadastro de usuários, administração de produtos e gerenciamento de vendas</strong>.
      </h3>
    </td>
  </tr>
</table>

---

## 🚀 Objetivo do Projeto

Criar um **site responsivo** para **desktop, tablets e smartphones**, que ofereça:

- Tela de cadastro e login de usuários
- Painel administrativo para gerenciar usuários e produtos
- Cadastro, listagem e edição de jogos
- Sistema de compra/venda de jogos
- Interface simples, responsiva e intuitiva

---

## 🛠️ Tecnologias Planejadas

O projeto será desenvolvido utilizando:

- **HTML5** → estrutura do site
- **CSS3** → estilização e design
- **Bootstrap 5** → responsividade e componentes prontos
- **JavaScript (ES6+)** → interatividade no front-end
- **PHP** → backend e regras de negócio
- **MySQL** → banco de dados para usuários e produtos

---

## 📌 Funcionalidades Planejadas

### 👤 Usuários

- Criar conta e fazer login
- Editar perfil
- Listar e visualizar jogos cadastrados
- Comprar jogos (futuro)

### 🛠️ Administradores

- Acessar painel administrativo
- Cadastrar novos jogos
- Gerenciar usuários
- Editar e remover produtos

---

## 🎯 Estrutura Inicial do Projeto

```
📁 Nexus_SixTech
├── 📁 Master
│   ├── 📁 css
│   │   ├── 🎨 help.css
│   │   ├── 🎨 master.css
│   │   ├── 🎨 orders.css
│   │   ├── 🎨 product.css
│   │   ├── 🎨 sales.css
│   │   ├── 🎨 systemVersion.css
│   │   └── 🎨 users.css
│   ├── 📁 documentation
│   │   ├── 🌐 about.html
│   │   └── 🌐 help.html
│   ├── 📁 feedback
│   │   ├── 🌐 faq.html
│   │   ├── 🌐 history.html
│   │   └── 🌐 question.html
│   ├── 📁 img
│   │   └── 🖼️ imgProject-Photoroom.png
│   ├── 📁 js
│   │   ├── 📄 graficos.js
│   │   ├── 📄 master.js
│   │   ├── 📄 orders.js
│   │   ├── 📄 product.js
│   │   ├── 📄 sales.js
│   │   ├── 📄 sidebar.js
│   │   ├── 📄 transition.js
│   │   └── 📄 users.js
│   ├── 📁 reports
│   │   ├── 🌐 orders.html
│   │   ├── 🌐 productReports.html
│   │   ├── 🌐 salesReports.html
│   │   └── 🌐 userReports.html
│   ├── 📁 system
│   │   ├── 🌐 backup.html
│   │   ├── 🌐 logs.html
│   │   └── 🌐 systemVersion.html
│   └── 🌐 master.html
├── 📁 css
│   ├── 🎨 Cart.css
│   ├── 🎨 cadastro.css
│   ├── 🎨 carrossel.css
│   ├── 🎨 gamepagestyle.css
│   ├── 🎨 homePage.css
│   └── 🎨 login.css
├── 📁 js
│   ├── 📄 Cart.js
│   ├── 📄 homePage.js
│   ├── 📄 login.js
│   ├── 📄 utils.js
│   └── 📄 validacoes.js
├── 📁 php
│   ├── 🐘 Cadastro.php
│   ├── 🐘 Cart.php
│   ├── 🐘 Conn.php
│   ├── 🐘 Index.php
│   ├── 🐘 Nintendo.php
│   ├── 🐘 Playstation.php
│   ├── 🐘 Xbox.php
│   ├── 🐘 login.php
│   └── 🐘 user.php
├── 📁 sql
│   └── 📄 Banco.sql
├── 📁 utils
│   ├── 📁 img
│   │   ├── 🖼️ LogoNintendo.png
│   │   ├── 🖼️ LogoPS.png
│   │   ├── 🖼️ capaNint.jpg
│   │   ├── 🖼️ capaNint2.jpg
│   │   ├── 🖼️ ghost-of-yotei-game-3840x2160-19048.jpg
│   │   ├── 🖼️ imgProject-Photoroom.png
│   │   ├── 🖼️ imgProject-removebg-preview.png
│   │   ├── 🖼️ imgProject.png
│   │   ├── 🖼️ logoXbox.png
│   │   └── 🖼️ user.png
│   ├── 📁 img_Banner
│   │   ├── 🖼️ Banner-Nintendo-Studios.jpg
│   │   ├── 🖼️ Banner-PS-Studios.jpg
│   │   └── 🖼️ Banner-xbox-Studios.jpg
│   ├── 📁 img_games_nintendo
│   │   ├── 🖼️ Earthworm_Jim_Super.jpg
│   │   ├── 🖼️ Final_Fight.jpg
│   │   ├── 🖼️ Legend_of_Zelda_Breath_of_the_Wild_capa.png
│   │   ├── 🖼️ Mario Kart 8 S pass.jpg
│   │   ├── 🖼️ Mario_Kart_8_Deluxe.jpg
│   │   ├── 🖼️ Super_Mario_64.jpg
│   │   ├── 🖼️ Super_Mario_Allstar.jpg
│   │   ├── 🖼️ Super_Mario_Party.png
│   │   ├── 🖼️ bomberman-generation-17334.jpg
│   │   ├── 🖼️ castlevania_dracula_x.jpg
│   │   └── 🖼️ the-legend-of-zelda-tears-of-the-kingdom_cover.jpg
│   ├── 📁 img_games_playstation
│   │   ├── 🖼️ Fallout76.jpg
│   │   ├── 🖼️ Ghost_of_Tsushima_capa.png
│   │   ├── 🖼️ GodofWar.jpg
│   │   ├── 🖼️ Star_Wars_Jedi_Fallen_Order_capa.png
│   │   ├── 🖼️ UntilDawn.jpg
│   │   ├── 🖼️ Wildarms.jpg
│   │   ├── 🖼️ dinocrisis.jpg
│   │   ├── 🖼️ ghost-of-yotei-game-3840x2160-19048.jpg
│   │   ├── 🖼️ starwars.jpg
│   │   ├── 🖼️ the-alters.jpg
│   │   └── 🖼️ thealters.png
│   ├── 📁 img_games_x-box
│   │   ├── 🖼️ Dishonored 2.jpg
│   │   ├── 🖼️ Doom.jpg
│   │   ├── 🖼️ Forza Motorsport 6.jpg
│   │   ├── 🖼️ Halo_Infinite_capa.png
│   │   ├── 🖼️ Sea-Of-Thieves-Emblema.jpg
│   │   ├── 🖼️ dishonored.jpg
│   │   ├── 🖼️ doomEternal.jpg
│   │   ├── 🖼️ gears of wars.png
│   │   ├── 🖼️ senuasSacrifice.jpg
│   │   └── 🖼️ senuasSaga.jpg
│   └── 🖼️ mario.gif
├── ⚙️ .gitignore
├── 📄 LICENSE
└── 📝 README.md
```

---

_Generated by FileTree Pro Extension_

---

## 📅 Status do Projeto

🚧 **Em Desenvolvimento** – Desenvolvimento quase finalizado da _v1.0_.

---

## 🤝 Contribuição

Contribuições serão bem-vindas assim que o projeto estiver em andamento.  
Sugestões de novas funcionalidades, melhorias de código e design são encorajadas!

1. Faça um **fork** do repositório
2. Crie uma **branch** com sua feature (`git checkout -b minha-feature`)
3. Faça o **commit** (`git commit -m 'Adiciona minha feature'`)
4. Faça o **push** (`git push origin minha-feature`)
5. Abra um **Pull Request**

---

## 📄 Licença

Este projeto será desenvolvido como **open source** sob a licença MIT.  
Sinta-se livre para usar, modificar e compartilhar.

---

## 👨‍💻 Autor

Projeto idealizado por **Nexus SixTech**.

Integrantes da **Nexus SixTech**:
[Yago](https://github.com/tenmenezes) |
[Yasmim](https://github.com/YasmimMantovani) |
[Thiago](https://github.com/Thiago-Rock) |
[Fred](https://github.com/FredWallace) |
[Carlos](https://github.com/ClaudinoGomes) |
[Bruno](https://github.com/Bruno-Washington).

Desenvolvido inicialmente como estudo prático em **HTML, CSS, JS, PHP e MySQL**.
