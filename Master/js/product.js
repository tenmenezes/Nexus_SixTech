// product.js (versão sem showModal, usando div-modals)

// referências aos elementos (IDs/classes devem existir no HTML)
const btnNovoProduto = document.getElementById("btnNovoProduto");
const newProductModal = document.getElementById("newProductDialog"); // container .modal-container
const editProductModal = document.getElementById("editProductDialog");
const deleteProductModal = document.getElementById("deleteProductModal");
const searchProduct = document.getElementById("searchProduct");

let rowToDelete = null; // referência à linha que será excluída

/* -------------------- helpers de modal -------------------- */
function openModal(modal) {
  modal.classList.remove("out");
  modal.classList.add("active");
}

function closeModal(modal) {
  modal.classList.remove("active");
  // animação de saída (se tiver .out no css)
  modal.classList.add("out");
  setTimeout(() => modal.classList.remove("out"), 1000); // remove classe out após a animação
}

/* Fecha modal clicando no background (supondo .modal-background direto dentro do container) */
function bindBackgroundClose(modal) {
  const bg = modal.querySelector(".modal-background");
  if (!bg) return;
  bg.addEventListener("click", (e) => {
    if (e.target === bg) closeModal(modal);
  });
}

/* Fecha modal ao clicar nos botões com classes .cancel ou .close */
function bindCancelButtons(modal) {
  modal.querySelectorAll(".cancel, .close").forEach((btn) => {
    btn.addEventListener("click", () => closeModal(modal));
  });
}

/* Validação básica: todos os inputs/selects não vazios */
function validarInputs(inputs) {
  for (const el of inputs) {
    // ignora elementos sem name/value (por segurança)
    if (!("value" in el)) continue;

    const v = String(el.value).trim();

    // select: considera vazio se value == ''
    if (el.tagName === "SELECT") {
      if (v === "") return false;
    } else if (el.type === "date") {
      if (v === "") return false;
    } else if (el.type === "number") {
      if (v === "" || isNaN(Number(v))) return false;
    } else {
      // input text, email, etc
      if (v === "") return false;
    }
  }
  return true;
}

/* formata data yyyy-mm-dd (input date) para dd/mm/yyyy */
function dateInputToPtBR(dateValue) {
  if (!dateValue) return "";
  // dateValue expected 'YYYY-MM-DD'
  const d = new Date(dateValue + "T00:00");
  return d.toLocaleDateString("pt-BR");
}

/* converte dd/mm/yyyy -> yyyy-mm-dd (para preencher input date) */
function ptBRToDateInput(ptbr) {
  if (!ptbr) return "";
  const parts = ptbr.split("/");
  if (parts.length !== 3) return "";
  return `${parts[2].padStart(4, "0")}-${parts[1].padStart(
    2,
    "0"
  )}-${parts[0].padStart(2, "0")}`;
}

/* -------------------- geração fake -------------------- */
function generateProducts(qty) {
  const plataformas = [
    "PC",
    "PlayStation",
    "Xbox",
    "Nintendo Switch",
    "Mobile",
  ];
  const generos = [
    "Ação",
    "Aventura",
    "RPG",
    "Esporte",
    "Estratégia",
    "Corrida",
    "Terror",
  ];

  let data = [];
  for (let i = 1; i <= qty; i++) {
    data.push({
      id: i,
      nome: "Jogo " + i,
      descricao: "Descrição do jogo " + i,
      preco: (Math.random() * 200 + 20).toFixed(2),
      plataforma: plataformas[Math.floor(Math.random() * plataformas.length)],
      genero: generos[Math.floor(Math.random() * generos.length)],
      estoque: Math.floor(Math.random() * 1000),
      data: new Date(
        +new Date() - Math.floor(Math.random() * 10000000000)
      ).toLocaleDateString("pt-BR"),
    });
  }
  return data;
}

/* -------------------- inicialização do Tabulator -------------------- */
const table = new Tabulator("#product-table", {
  data: generateProducts(50),
  layout: "fitColumns",
  responsiveLayout: "hide",
  pagination: "local",
  paginationSize: 20,
  movableColumns: true,
  columns: [
    { title: "Nome", field: "nome" },
    { title: "Descrição", field: "descricao" },
    {
      title: "Preço (R$)",
      field: "preco",
      hozAlign: "center",
      formatter: "money",
      formatterParams: { decimal: ",", thousand: ".", symbol: "R$" },
    },
    { title: "Plataforma", field: "plataforma" },
    { title: "Gênero", field: "genero" },
    { title: "Estoque", field: "estoque", hozAlign: "center" },
    { title: "Data", field: "data" },
    {
      title: "Ações",
      field: "acoes",
      hozAlign: "center",
      formatter: function () {
        // área de clique maior com spans
        return `
          <div style="display:flex; justify-content:center; gap:10px;">
            <span class="editar actionBtn" title="Editar"><i class="fa-solid fa-pen-to-square edit"></i></span>
            <span class="excluir actionBtn" title="Excluir"><i class="fas fa-trash delet"></i></span>
          </div>
        `;
      },
      // cellClick recebe evento DOM como primeiro argumento
      cellClick: function (e, cell) {
        const row = cell.getRow();
        const rowData = row.getData();

        if (e.target.closest(".editar")) {
          abrirEdicaoProduto(rowData, row);
        } else if (e.target.closest(".excluir")) {
          abrirDeleteProduto(row);
        }
      },
    },
  ],
});

/* -------------------- edição / inserção / exclusão -------------------- */

// Abre modal de edição preenchendo os campos
function abrirEdicaoProduto(data, row) {
  // preenche inputs dentro do modal (assume ordem: nome, descricao, preco, plataforma, genero, estoque, data)
  editProductModal.rowRef = row;
  const inputs = editProductModal.querySelectorAll("input, select");
  inputs[0].value = data.nome ?? "";
  inputs[1].value = data.descricao ?? "";
  inputs[2].value = data.preco ?? "";
  inputs[3].value = data.plataforma ?? "";
  inputs[4].value = data.genero ?? "";
  inputs[5].value = data.estoque ?? "";
  inputs[6].value = ptBRToDateInput(data.data ?? "");
  openModal(editProductModal);
}

// Abre modal de novo produto (limpa campos)
function abrirNovoProduto() {
  const inputs = newProductModal.querySelectorAll("input, select");
  inputs.forEach((i) => (i.value = ""));
  openModal(newProductModal);
}

// Abre modal de confirmação de exclusão
function abrirDeleteProduto(row) {
  rowToDelete = row;
  openModal(deleteProductModal);
}

/* bind fechar por background e botões */
[newProductModal, editProductModal, deleteProductModal].forEach((m) => {
  if (!m) return;
  bindBackgroundClose(m);
  bindCancelButtons(m);
});

/* Botão criar novo produto */
if (btnNovoProduto) {
  btnNovoProduto.addEventListener("click", abrirNovoProduto);
}

/* SALVAR - novo produto */
if (newProductModal) {
  const saveBtn = newProductModal.querySelector(".save");
  saveBtn.addEventListener("click", () => {
    const inputs = newProductModal.querySelectorAll("input, select");
    if (!validarInputs(inputs)) {
      alert("Preencha todos os campos antes de salvar.");
      return;
    }

    const newProduct = {
      // id único (timestamp) para evitar colisão após exclusões
      id: Date.now(),
      nome: inputs[0].value,
      descricao: inputs[1].value,
      preco: Number(inputs[2].value).toFixed(2),
      plataforma: inputs[3].value,
      genero: inputs[4].value,
      estoque: Number(inputs[5].value),
      data: dateInputToPtBR(inputs[6].value),
    };

    table.addData([newProduct]);
    closeModal(newProductModal);
    inputs.forEach((i) => (i.value = ""));
  });
}

/* SALVAR - edição */
if (editProductModal) {
  const saveEdit = editProductModal.querySelector(".save");
  saveEdit.addEventListener("click", () => {
    const inputs = editProductModal.querySelectorAll("input, select");
    if (!validarInputs(inputs)) {
      alert("Preencha todos os campos antes de salvar.");
      return;
    }

    const row = editProductModal.rowRef;
    if (!row) {
      alert("Erro: referência da linha não encontrada.");
      closeModal(editProductModal);
      return;
    }

    row.update({
      nome: inputs[0].value,
      descricao: inputs[1].value,
      preco: Number(inputs[2].value).toFixed(2),
      plataforma: inputs[3].value,
      genero: inputs[4].value,
      estoque: Number(inputs[5].value),
      data: dateInputToPtBR(inputs[6].value),
    });

    closeModal(editProductModal);
  });
}

/* Exclusão: cancelar/janela já ligada; confirmar: */
if (deleteProductModal) {
  const confirmBtn = deleteProductModal.querySelector(".confirm");
  confirmBtn.addEventListener("click", () => {
    if (rowToDelete) {
      rowToDelete.delete();
      rowToDelete = null;
    }
    closeModal(deleteProductModal);
  });
}

/* -------------------- pesquisa global -------------------- */
if (searchProduct) {
  searchProduct.addEventListener("input", function () {
    const termo = searchProduct.value.trim().toLowerCase();
    if (termo === "") {
      table.clearFilter();
    } else {
      table.setFilter((data) =>
        Object.values(data).some((value) =>
          String(value).toLowerCase().includes(termo)
        )
      );
    }
  });
}

/* -------------------- binds opcionais para fechar modals com ESC -------------------- */
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    [newProductModal, editProductModal, deleteProductModal].forEach((m) => {
      if (m && m.classList.contains("active")) closeModal(m);
    });
  }
});
