let NomeTabela = '';
let currentId = null;
let tableHeaders = [];
let currentSection = 'users'; // seção ativa

// Configuração de colunas específicas por seção
const sectionColumns = {
  'users': ['id', 'nome', 'cpf', 'mae', 'email', 'criado'], // exemplo: apenas essas colunas
  'games': ['id', 'nome', 'preco', 'plataforma', 'estoque'],
  'orders': ['id', 'user_id', 'total', 'data_pedido', 'status'],
  'session_logs': null // null = todas as colunas
};

// Função para carregar dados de uma seção específica
async function loadDataForSection(section) {
  currentSection = section;
  
  const tableMap = {
    'users': 'users',
    'games': 'games', 
    'orders': 'orders',
    'session_logs': 'session_logs'
  };
  
  NomeTabela = tableMap[section] || 'users';
  
  const tableId = `dataTable-${section}`;
  const formContainerId = `formContainer-${section}`;
  const formFieldsId = `formFields-${section}`;
  
  const res = await fetch(`http://localhost/API/API.php?action=read&table=${NomeTabela}`);
  const data = await res.json();

  const tableEl = document.getElementById(tableId);
  if (!tableEl) return;
  
  tableEl.innerHTML = "";

  if (data.error) return alert(data.error);
  if (!data.length) {
    tableEl.innerHTML = "<tr><td>Sem dados</td></tr>";
    return;
  }

  // Usar colunas específicas se definidas, senão usar todas
  const specificColumns = sectionColumns[section];
  tableHeaders = specificColumns || Object.keys(data[0]);

  // Controlar se a seção tem ações
  const hasActions = section !== 'session_logs';

  let headerRow = "<tr>" + tableHeaders.map(h => `<th>${h}</th>`).join("") + 
                  (hasActions ? "<th>Ações</th>" : "") + "</tr>";
  tableEl.innerHTML = headerRow;

  console.log(tableId);

  data.forEach(row => {
    // Filtrar apenas as colunas definidas em tableHeaders
    const rowHTML = tableHeaders.map(h => `<td>${row[h] ?? ''}</td>`).join("");
    
    const actionsHTML = hasActions ? `
        <td class="actions">
          <button class="btn-icon btn-edit" title="Editar" onclick="editRow(${row.id})"><i class="fa-solid fa-pen-to-square"></i></button>
          <button class="btn-icon btn-delete" title="Excluir" onclick="deleteRow(${row.id})"><i class="fa-solid fa-trash-can"></i></button>
        </td>` : '';
    
    tableEl.innerHTML += `
      <tr>
        ${rowHTML}
        ${actionsHTML}
      </tr>
    `;
  });

  buildFormFields(data[0]);
}

async function loadData() {
  loadDataForSection(currentSection);
}

function buildFormFields(sampleRow) {
  const formFieldsId = `formFields-${currentSection}`;
  const formContainerId = `formContainer-${currentSection}`;
  
  const container = document.getElementById(formFieldsId);
  if (!container) return;
  
  container.innerHTML = "";
  for (const key of Object.keys(sampleRow)) {
    if (key === "id") continue;
    container.innerHTML += `
      <label>${key}: <input type="text" name="${key}" id="field_${key}"></label><br>
    `;
  }
  
  const formContainer = document.getElementById(formContainerId);
  if (formContainer) formContainer.style.display = "block";
}

function getFormData() {
  const data = {};
  const formFieldsId = `formFields-${currentSection}`;
  const container = document.getElementById(formFieldsId);
  
  if (!container) return data;
  
  // Buscar todos os inputs dentro do container do formulário
  const inputs = container.querySelectorAll('input[name]');
  inputs.forEach(input => {
    const fieldName = input.getAttribute('name');
    if (fieldName && fieldName !== 'id') {
      data[fieldName] = input.value;
    }
  });
  
  // Adicionar o ID se estiver editando
  if (currentId) data.id = currentId;
  
  return data;
}

function searchTable() {
  const searchInput = document.getElementById('search_nome');
  if (!searchInput) return;
  
  const searchTerm = searchInput.value.toLowerCase().trim();
  const tableId = `dataTable-${currentSection}`;
  const table = document.getElementById(tableId);
  if (!table) return;
  
  const rows = table.querySelectorAll('tbody tr, tr:not(:first-child)');
  
  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    row.style.display = text.includes(searchTerm) ? '' : 'none';
  });
}

async function saveData(e) {
  e.preventDefault();
  const data = getFormData();
  const action = currentId ? 'update' : 'create';

  const res = await fetch(`http://localhost/API/API.php?action=${action}&table=${NomeTabela}`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });
  const result = await res.json();

  if (result.error) alert(result.error);
  else {
    currentId = null;
    const formId = `dataForm-${currentSection}`;
    const form = document.getElementById(formId);
    if (form) form.reset();
    
    // Fechar o modal de edição após salvar
    const editModal = document.getElementById('editUserModal');
    if (editModal) {
      editModal.style.display = 'none';
    }
    
    // Abrir modal de sucesso
    const successModal = document.getElementById('successModal');
    const successMessage = document.getElementById('successMessage');
    if (successModal && successMessage) {
      successMessage.textContent = '✅ Registo guardado com sucesso!';
      successModal.style.display = 'flex';
    }
    
    loadData();
  }
}

async function editRow(id) {
  try {
    // Buscar dados completos do registro do servidor
    const res = await fetch(`http://localhost/API/API.php?action=read&table=${NomeTabela}`);
    const data = await res.json();
    
    if (data.error) {
      alert(data.error);
      return;
    }
    
    // Encontrar o registro específico pelo ID
    const record = data.find(row => parseInt(row.id) === parseInt(id));
    
    if (!record) {
      alert('Registro não encontrado');
      return;
    }
    
    // Preencher todos os campos do formulário com os dados completos
    Object.keys(record).forEach(key => {
      if (key !== "id") {
        const field = document.getElementById(`field_${key}`);
        if (field) {
          field.value = record[key] || '';
        }
      }
    });
    
    currentId = id;
    const formTitleId = `formTitle-${currentSection}`;
    const formTitle = document.getElementById(formTitleId);
    if (formTitle) formTitle.innerText = "Editar Registo";
    
    // Abrir o modal de edição
    const editModal = document.getElementById('editUserModal');
    if (editModal) {
      editModal.style.display = 'flex';
    }
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
    
  } catch (error) {
    console.error('Erro ao buscar dados do registro:', error);
    alert('Erro ao carregar dados para edição');
  }
}

async function deleteRow(id) {
  // Armazenar o ID para usar quando confirmar
  const deleteModal = document.getElementById('deleteUserModal');
  if (!deleteModal) return;
  
  // Abrir o modal de confirmação
  deleteModal.style.display = 'flex';
  
  // Buscar o botão de confirmação
  const confirmBtn = deleteModal.querySelector('.confirm');
  
  // Remover listeners antigos para evitar duplicação
  const newConfirmBtn = confirmBtn.cloneNode(true);
  confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
  
  // Adicionar novo listener para confirmação
  newConfirmBtn.addEventListener('click', async () => {
    deleteModal.style.display = 'none';
    
    try {
      const res = await fetch(`http://localhost/API/API.php?action=delete&table=${NomeTabela}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
      });
      const result = await res.json();

      if (result.error) {
        alert(result.error);
      } else {
        // Abrir modal de sucesso
        const successModal = document.getElementById('successModal');
        const successMessage = document.getElementById('successMessage');
        if (successModal && successMessage) {
          successMessage.textContent = '🗑️ Registo eliminado com sucesso!';
          successModal.style.display = 'flex';
        }
        loadData();
      }
    } catch (error) {
      console.error('Erro ao deletar registro:', error);
      alert('Erro ao deletar registro');
    }
  });
}

function cancelEdit() {
  currentId = null;
  const formId = `dataForm-${currentSection}`;
  const formTitleId = `formTitle-${currentSection}`;
  
  const form = document.getElementById(formId);
  if (form) form.reset();
  
  const formTitle = document.getElementById(formTitleId);
  if (formTitle) formTitle.innerText = "Adicionar Registo";
  
  // Fechar o modal de edição
  const editModal = document.getElementById('editUserModal');
  if (editModal) {
    editModal.style.display = 'none';
  }
}

//Seleção de elementos DOM e eventos de modal
const editUserModal = document.getElementById("editUserModal");
const deleteUserModal = document.getElementById("deleteUserModal");
const cancelDeleteBtn = deleteUserModal.querySelector(".cancel");
const confirmDeleteBtn = deleteUserModal.querySelector(".confirm");
const closeDeleteBtn = deleteUserModal.querySelector(".close");

// Fechar modal ao clicar no botão cancelar
document.querySelectorAll(".modal-container .cancel").forEach((btn) => {
  btn.addEventListener("click", () => {
    const modal = btn.closest(".modal-container");
    if (modal) {
      modal.style.display = 'none';
    }
  });
});

// Fechar clicando no background
document.querySelectorAll(".modal-container").forEach((modal) => {
  modal.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal-background")) {
      modal.style.display = 'none';
    }
  });
});

// Fechar modal de exclusão com background ou X
if (deleteUserModal) {
  const deleteBackground = deleteUserModal.querySelector(".modal-background");
  if (deleteBackground) {
    deleteBackground.addEventListener("click", () => {
      deleteUserModal.style.display = 'none';
    });
  }
}

if (closeDeleteBtn) {
  closeDeleteBtn.addEventListener("click", () => {
    deleteUserModal.style.display = 'none';
  });
}

if (cancelDeleteBtn) {
  cancelDeleteBtn.addEventListener("click", () => {
    deleteUserModal.style.display = 'none';
  });
}

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
      'nome', 'nascimento', 'genero', 'mae', 'cpf', 'email', 'celular',
      'rua', 'bairro', 'cidade', 'estado', 'login', 'user_type'
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
    if (field === 'celular' && !VALIDATIONS.celular(value)) {
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
// Event listener para o formulário de edição
document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('dataForm-users');
  if (editForm) {
    editForm.addEventListener('submit', saveData);
  }
  
  // Listener para fechar o modal de sucesso ao clicar em OK
  const successOkBtn = document.getElementById('successOkBtn');
  if (successOkBtn) {
    successOkBtn.addEventListener('click', () => {
      const successModal = document.getElementById('successModal');
      if (successModal) {
        successModal.style.display = 'none';
        loadData();
      }
    });
  }
  
  // Listener para fechar modal de sucesso ao clicar no fundo
  const successModal = document.getElementById('successModal');
  if (successModal) {
    const successBackground = successModal.querySelector('.modal-background');
    if (successBackground) {
      successBackground.addEventListener('click', () => {
        successModal.style.display = 'none';
      });
    }
  }
});
