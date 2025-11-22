import { CONFIG } from './config.js';
import { getUsuarios, saveUser, deleteUser } from "./dados.js";

// Estado global da aplicação
const state = {
 table: null,
 tableData: [],
 rowToDelete: null,
 isLoading: false,
 lastError: null
};

// Utilitários
function debounce(fn, delay) {
 let timeoutId;
 return (...args) => {
  clearTimeout(timeoutId);
  timeoutId = setTimeout(() => fn(...args), delay);
 };
}

function showMessage(message, type = 'success') {
 const messageEl = document.createElement('div');
 messageEl.className = `message message-${type}`;
 messageEl.setAttribute('role', 'alert');
 messageEl.textContent = message;
 
  // Usa o body para garantir que a mensagem não fique presa no modal
 document.body.appendChild(messageEl); 
 
 setTimeout(() => messageEl.remove(), CONFIG.TIMEOUTS.MESSAGE_DURATION);
}

function showLoading(show = true) {
 const loadingEl = document.querySelector('.loading-indicator');
 if (loadingEl) {
    loadingEl.hidden = !show;
 }
}

// Seleção de elementos DOM
// const btnNovo = document.getElementById("btnNovo");
// const newUserModal = document.getElementById("newUserModal");
// const newUserForm = document.getElementById("newUserForm");
const editUserModal = document.getElementById("editUserModal");
const deleteUserModal = document.getElementById("deleteUserModal");
const cancelDeleteBtn = deleteUserModal.querySelector(".cancel");
const confirmDeleteBtn = deleteUserModal.querySelector(".confirm");
const closeDeleteBtn = deleteUserModal.querySelector(".close");
const searchInput = document.getElementById("searchInput");

// Abrir modal novo usuário
btnNovo.addEventListener("click", () => {
 // Reseta o formulário de novo usuário para evitar dados residuais
 if (newUserForm) {
   try { newUserForm.reset(); } catch (e) { /* ignore */ }
   // Remove eventual campo id caso exista (não deve haver para novo)
   const idField = newUserForm.querySelector('input[name="id"]');
   if (idField) idField.remove();
 }
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

// Fechar modal de exclusão com background ou X
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

// // Validações
const VALIDATIONS = {
 email: (value) => CONFIG.VALIDATION_PATTERNS.email.test(value),
 cpf: (value) => CONFIG.VALIDATION_PATTERNS.cpf.test(value),
 cep: (value) => CONFIG.VALIDATION_PATTERNS.cep.test(value),
 celular: (value) => CONFIG.VALIDATION_PATTERNS.celular.test(value),
 required: (value) => value.trim().length > 0
};

function validateForm(inputs) {
 const errors = [];
 const data = {};
 
 inputs.forEach(input => {
  // Adição de verificação de campos vazios para novos campos obrigatórios
    const field = input.getAttribute('name');
    const value = input.value.trim();

    // Se o campo for 'id', apenas armazena.
    if (field === 'id') {
      data[field] = value;
      return;
    }
    
    // Lista de campos obrigatórios
    const requiredFields = [
        'nome', 'dt_nas', 'genero', 'mother_name', 'cpf', 'email', 'cel', 
        'street', 'neighborhood', 'city', 'state', 'login', 'categoria'
    ];
    // Se for o formulário de edição, a 'senha' só é obrigatória se preenchida
    const isEditForm = input.closest('#editUserForm');

    if (requiredFields.includes(field) && !VALIDATIONS.required(value)) {
        errors.push(CONFIG.VALIDATION_MESSAGES.required(field));
        return;
    }
    // Para edição, a senha não é obrigatória. Para novo usuário, é.
    if (field === 'senha' && !isEditForm && !VALIDATIONS.required(value)) {
        errors.push(CONFIG.VALIDATION_MESSAGES.required(field));
        return;
    }

    // Validações específicas
  if (field === 'email' && !VALIDATIONS.email(value)) {
   errors.push(CONFIG.VALIDATION_MESSAGES.invalid(field));
   return;
  }
    if (field === 'cpf' && !VALIDATIONS.cpf(value)) {
   errors.push(CONFIG.VALIDATION_MESSAGES.invalid(field));
   return;
  }
    if (field === 'cep' && !VALIDATIONS.cep(value)) {
   errors.push(CONFIG.VALIDATION_MESSAGES.invalid(field));
   return;
  }
    if (field === 'cel' && !VALIDATIONS.celular(value)) {
   errors.push(CONFIG.VALIDATION_MESSAGES.invalid(field));
   return;
  }
  
  data[field] = value;
 });
 
 return { isValid: errors.length === 0, errors, data };
}

// Sanitização
function sanitizeInput(value) {
 const div = document.createElement('div');
 div.textContent = value;
 return div.innerHTML;
}

function sanitizeFormData(data) {
 return Object.fromEntries(
  Object.entries(data).map(([k, v]) => [k, sanitizeInput(v)])
 );
}

// Inicialização da aplicação
async function init() {
 try {
  showLoading(true);
  console.log("Buscando dados do servidor...");
  
  // 1. Busca os dados do PHP
  state.tableData = await getUsuarios();

  if (state.tableData.length === 0) {
   showMessage("Nenhum usuário encontrado.", "warning");
  }

  // 2. Inicializa tabela Tabulator
  state.table = new Tabulator("#user-table", {
   data: state.tableData,
   layout: "fitColumns",
   responsiveLayout: "collapse",
   pagination: "local",
   paginationSize: 20,
   movableColumns: true,
   columns: [
    { 
     title: "ID", 
     field: "id", 
     width: 50,
     headerFilter: true
    },
    { 
     title: "Nome", 
     field: "nome", // full_name via alias
     headerFilter: true
    },
    { 
     title: "Email", 
     field: "email",
     headerFilter: true
    },
    { 
     title: "CPF", 
     field: "cpf",
     headerFilter: true
    },
    { 
     title: "Celular", 
     field: "cel", // mobile_phone via alias
     headerFilter: true
    },
        { 
     title: "Endereço", 
     field: "street",
     headerFilter: true,
          // Formata a visualização do endereço combinando vários campos
          formatter: function(cell, formatterParams, onRendered) {
              const data = cell.getRow().getData();
              const ruaNum = data.street && data.number ? `${data.street}, ${data.number}` : data.street || '';
              const cidadeEstado = data.city && data.state ? `${data.city}/${data.state}` : data.city || '';
              return [ruaNum, data.neighborhood, cidadeEstado].filter(Boolean).join(' - ');
          }
    },
    { 
     title: "Categoria", 
     field: "categoria", // user_type via alias
     headerFilter: true
    },
    {
     title: "Ações",
     field: "acoes",
     hozAlign: "center",
     formatter: function(cell, formatterParams, onRendered) {
      return `
       <button class="btn-edit" title="Editar">
        <i class="fa-solid fa-pen-to-square"></i>
       </button>
       <button class="btn-delete" title="Excluir">
        <i class="fas fa-trash"></i>
       </button>
      `;
     },
     cellClick: function(e, cell) {
      const target = e.target.closest('button');
      if (!target) return;

      const rowData = cell.getRow().getData();
      const row = cell.getRow();

      if (target.classList.contains('btn-edit')) {
       abrirEdicao(rowData, row);
      } else if (target.classList.contains('btn-delete')) {
       state.rowToDelete = row;
       deleteUserModal.classList.add("active");
      }
     }
    }
   ],
   rowFormatter: function(row) {
    // Linhas com o status 'deletado' devem ter a cor alterada
        // A lógica de 'deletado' depende de como você lida com exclusão no DB
    if (row.getData().deletado) { 
     row.getElement().style.backgroundColor = "#ffebee";
    }
   }
  });

  // 3. Configurar pesquisa com debounce
  searchInput.addEventListener("input", debounce(function() {
   const termo = this.value.toLowerCase();
   if (termo === "") {
    state.table.clearFilter();
   } else {
    state.table.setFilter((data) =>
     Object.values(data).some((v) => 
      String(v).toLowerCase().includes(termo)
     )
    );
   }
  }, CONFIG.TIMEOUTS.DEBOUNCE_SEARCH));

 } catch (error) {
  console.error("Erro na inicialização:", error);
  showMessage(
   "Erro ao carregar dados. Tente novamente mais tarde.", 
   "error"
  );
 } finally {
  showLoading(false);
 }
}

// Iniciar quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', init);

// Handlers dos modais
async function handleSaveUser(inputs, isNew = false) {
 try {
  // Aqui o validateForm coleta todos os campos, incluindo os novos
  const { isValid, errors, data } = validateForm(inputs); 
  
  if (!isValid) {
   showMessage(errors.join('\n'), 'error');
   return false;
  }

  showLoading(true);
  
  // Sanitizar e preparar dados
  const userData = sanitizeFormData({
   ...data,
   // O campo 'atualizacao' é definido no back-end (PHP)
  });

  // Salvar no backend
  const savedUser = await saveUser(userData);

  // Atualizar UI
  if (isNew) {
   state.table.addData([savedUser]);
  } else {
   const row = editUserModal.rowRef;
   row.update(savedUser);
  }

  showMessage(
   isNew ? 'Usuário criado com sucesso!' : 'Usuário atualizado com sucesso!',
   'success'
  );
  return true;

 } catch (error) {
  console.error("Erro ao salvar usuário:", error);
  showMessage(
   `Erro ao ${isNew ? 'criar' : 'atualizar'} usuário: ${error.message}`,
   'error'
  );
  return false;
 } finally {
  showLoading(false);
 }
}

// Função para abrir dialog de edição
function abrirEdicao(data, row) {
 editUserModal.classList.add("active");
 editUserModal.rowRef = row;
 
 // Lista COMPLETA de campos que serão preenchidos
 const fields = [
      'nome', 'dt_nas', 'genero', 'mother_name', 'cpf', 'email', 
      'cel', 'home_phone', 'cep', 'street', 'number', 'complement',
      'neighborhood', 'city', 'state', 'login', 'senha', 'categoria'
  ];

 // Preenche os campos do modal de edição
 fields.forEach(field => {
    const input = document.getElementById(`edit-${field}`);
    if (input) {
      // Usa um valor vazio para a senha no modal de edição
      input.value = field === 'senha' ? '' : data[field] || ''; 
    }
 });
 // Preenche o campo hidden com o id do usuário
 const idInput = document.getElementById('edit-id');
 if (idInput) {
   idInput.value = data.id || '';
 }
}

// Note: save buttons now submit native forms to the server-side handler.
// The JS-based save handlers were removed to avoid double-submission.

// Evento excluir usuário
confirmDeleteBtn.addEventListener("click", async () => {
 if (!state.rowToDelete) return;
 
 try {
  showLoading(true);
  const userId = state.rowToDelete.getData().id;
  await deleteUser(userId);
  
  state.rowToDelete.delete();
  showMessage('Usuário excluído com sucesso!', 'success');
  
 } catch (error) {
  console.error("Erro ao excluir usuário:", error);
  showMessage(`Erro ao excluir usuário: ${error.message}`, 'error');
  
 } finally {
  state.rowToDelete = null;
  deleteUserModal.classList.remove("active");
  showLoading(false);
 }
});

// Tratamento de conexão
window.addEventListener('online', () => {
 showMessage('Conexão restaurada! Atualizando dados...', 'info');
 init();
});

window.addEventListener('offline', () => {
 showMessage(
  'Sem conexão! Algumas funcionalidades podem estar indisponíveis.', 
  'warning'
 );
});