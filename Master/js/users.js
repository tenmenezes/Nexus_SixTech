import { getUsuarios } from "./dados.js";

// Seleção

const btnNovo = document.getElementById("btnNovo");
const newUserModal = document.getElementById("newUserModal");
const editUserModal = document.getElementById("editUserModal");
const deleteUserModal = document.getElementById("deleteUserModal");
const cancelDeleteBtn = deleteUserModal.querySelector(".cancel");
const confirmDeleteBtn = deleteUserModal.querySelector(".confirm");
const closeDeleteBtn = deleteUserModal.querySelector(".close");

let rowToDelete = null; // guarda a referência da linha que será deletada

// Abrir modal novo usuário

btnNovo.addEventListener("click", () => {
  newUserModal.classList.remove("out");
  newUserModal.classList.add("active");
});

// Fechar modal
document.querySelectorAll(".modal-container .cancel").forEach((btn) => {
  btn.addEventListener("click", () => {
    const modal = btn.closest(".modal-container");
    modal.classList.remove("active");
    modal.classList.add("out");

    // Remove a classe "out" depois da animação
    setTimeout(() => modal.classList.remove("out"), 500);
  });
});

// Fechar clicando no background
document.querySelectorAll(".modal-container").forEach((modal) => {
  modal.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal-background")) {
      modal.classList.remove("active");
      modal.classList.add("out");
      setTimeout(() => modal.classList.remove("out"), 500);
    }
  });
});

// Fechar modal com background ou X
deleteUserModal
  .querySelector(".modal-background")
  .addEventListener("click", (e) => {
    if (e.target === deleteUserModal.querySelector(".modal-background"))
      deleteUserModal.classList.remove("active");
  });
closeDeleteBtn.addEventListener("click", () =>
  deleteUserModal.classList.remove("active")
);
cancelDeleteBtn.addEventListener("click", () =>
  deleteUserModal.classList.remove("active")
);

// Confirmar exclusão
confirmDeleteBtn.addEventListener("click", () => {
  if (rowToDelete) {
    rowToDelete.delete();
    rowToDelete = null;
    deleteUserModal.classList.remove("active");
  }
});

// // Função para gerar usuários automáticos
// function gerarUsuarios(qtd) {
//   const usuarios = [];
//   const nomes = [
//     "Ana",
//     "Bruno",
//     "Carlos",
//     "Diana",
//     "Eduardo",
//     "Fernanda",
//     "Gabriel",
//     "Helena",
//     "Igor",
//     "Julia",
//   ];
//   const sobrenomes = [
//     "Silva",
//     "Souza",
//     "Oliveira",
//     "Pereira",
//     "Almeida",
//     "Costa",
//     "Rodrigues",
//     "Martins",
//     "Barbosa",
//     "Ferreira",
//   ];

//   for (let i = 1; i <= qtd; i++) {
//     const nome = `${nomes[Math.floor(Math.random() * nomes.length)]} ${
//       sobrenomes[Math.floor(Math.random() * sobrenomes.length)]
//     }`;
//     const cpf = `${Math.floor(100 + Math.random() * 900)}.${Math.floor(
//       100 + Math.random() * 900
//     )}.${Math.floor(100 + Math.random() * 900)}-${Math.floor(
//       10 + Math.random() * 90
//     )}`;
//     const login = `user${i}`;
//     const email = `user${i}@teste.com`;
//     const celular = `+55 (21) 9${Math.floor(
//       1000 + Math.random() * 9000
//     )}-${Math.floor(1000 + Math.random() * 9000)}`;
//     const cep = `${Math.floor(10000 + Math.random() * 90000)}-${Math.floor(
//       100 + Math.random() * 900
//     )}`;
//     const dt_nas = `${String(Math.floor(1 + Math.random() * 28)).padStart(
//       2,
//       "0"
//     )}/${String(Math.floor(1 + Math.random() * 12)).padStart(2, "0")}/${
//       1980 + Math.floor(Math.random() * 25)
//     }`;
//     const hora = new Date().toLocaleTimeString("pt-BR");
//     const data = new Date().toLocaleDateString("pt-BR");

//     usuarios.push({
//       id: i,
//       nome,
//       dt_nas,
//       genero: Math.random() > 0.5 ? "M" : "F",
//       cpf,
//       email,
//       cel: celular,
//       cep,
//       login,
//       senha: "**********",
//       categoria: "NULL",
//       criacao: `${hora} ${data}`,
//       atualizacao: "NULL",
//     });
//   }
//   return usuarios;
// }

// // Gera 50 usuários automaticamente
// let tableData = gerarUsuarios(50);

// Inicializa tabela Tabulator
// Função para Inicializar a Aplicação
async function init() {
  console.log("Buscando dados do servidor...");
  
  // 1. Busca os dados do PHP
  const tableData = await getUsuarios();

  if (tableData.length === 0) {
    console.warn("Nenhum usuário retornado para a tabela.");
    // Você pode exibir uma mensagem de erro ou loading aqui
  }

  // 2. Inicializa tabela Tabulator com os dados buscados
  const table = new Tabulator("#user-table", {
    // ... (o restante da configuração da tabela Tabulator) ...
    data: tableData, // AGORA USAMOS OS DADOS REAIS DO PHP
    layout: "fitColumns",
    responsiveLayout: "collapse",
    pagination: "local",
    paginationSize: 20,
    movableColumns: true,
    columns: [
      { title: "ID", field: "id", width: 50 },
      // ... todas as outras colunas aqui ...
      { title: "Nome", field: "nome" },
      { title: "Data Nasc.", field: "dt_nas" },
      // ...
      {
        title: "Ações",
        field: "acoes",
        hozAlign: "center",
        // ... (o restante da configuração de Ações) ...
      },
    ],
  });
  
  // 3. Adicione a referência da tabela ao escopo global ou a um objeto para que as outras funções a acessem
  window.userTable = table; 
  
  // 4. Mantenha os Listeners
  // (O resto do seu código, como o evento de pesquisa, deve usar window.userTable)
  searchInput.addEventListener("input", function () {
      let termo = searchInput.value.toLowerCase();
      if (termo === "") window.userTable.clearFilter();
      else
          window.userTable.setFilter((data) =>
              Object.values(data).some((v) => String(v).toLowerCase().includes(termo))
          );
  });
}

// Inicia a aplicação
init();

// Função para abrir dialog de edição
function abrirEdicao(data, row) {
  editUserModal.classList.add("active");
  editUserModal.rowRef = row; // referencia da linha
  const inputs = editUserModal.querySelectorAll("input, select");
  inputs[0].value = data.nome;
  inputs[1].value = data.dt_nas;
  inputs[2].value = data.genero;
  inputs[3].value = data.cpf;
  inputs[4].value = data.email;
  inputs[5].value = data.cel;
  inputs[6].value = data.cep;
  inputs[7].value = data.login;
  inputs[8].value = data.senha;
  inputs[9].value = data.categoria;
}

// Evento salvar edição
editUserModal.querySelector(".save").addEventListener("click", () => {
  const inputs = editUserModal.querySelectorAll("input, select");
  const row = editUserModal.rowRef;
  if (
    !(
      inputs[0].value &&
      inputs[1].value &&
      inputs[2].value &&
      inputs[3].value &&
      inputs[4].value &&
      inputs[5].value &&
      inputs[6].value
    )
  ) {
    confirm("Erro: preencha os campos antes de salvar!");
  } else {
    row.update({
      nome: inputs[0].value,
      dt_nas: inputs[1].value,
      genero: inputs[2].value,
      cpf: inputs[3].value,
      email: inputs[4].value,
      cel: inputs[5].value,
      cep: inputs[6].value,
      login: inputs[7].value,
      senha: inputs[8].value,
      categoria: inputs[9].value,
      atualizacao: new Date().toLocaleString("pt-BR"),
    });
    editUserModal.classList.remove("active");
  }
});

// Inserção manual de usuário
btnNovo.addEventListener("click", () => {
  newUserModal.classList.add("active");
});

// Evento salvar novo usuário
newUserModal.querySelector(".save").addEventListener("click", () => {
  const inputs = newUserModal.querySelectorAll("input, select");

  if (
    !(
      inputs[0].value &&
      inputs[1].value &&
      inputs[2].value &&
      inputs[3].value &&
      inputs[4].value &&
      inputs[5].value &&
      inputs[6].value
    )
  ) {
    confirm("Erro: preencha os campos antes de salvar!");
  } else {
    const newUser = {
      id: tableData.length + 1,
      nome: inputs[0].value,
      dt_nas: inputs[1].value,
      genero: inputs[2].value,
      cpf: inputs[3].value,
      email: inputs[4].value,
      cel: inputs[5].value,
      cep: inputs[6].value,
      login: inputs[7].value,
      senha: inputs[8].value,
      categoria: inputs[9].value,
      criacao: new Date().toLocaleString("pt-BR"),
      atualizacao: "NULL",
    };
    table.addData([newUser]);
    newUserModal.classList.remove("active");
    inputs.forEach((i) => (i.value = "")); // limpa inputs
  }
});

// Pesquisa global
const searchInput = document.getElementById("searchInput");
searchInput.addEventListener("input", function () {
  let termo = searchInput.value.toLowerCase();
  if (termo === "") table.clearFilter();
  else
    table.setFilter((data) =>
      Object.values(data).some((v) => String(v).toLowerCase().includes(termo))
    );
});
