let NomeTabela = '';
let currentId = null;
let tableHeaders = [];
let currentSection = 'users';

// Configuração de colunas específicas por seção
const sectionColumns = {
  'users': ['id', 'nome', 'cpf', 'mae', 'email', 'criado'],
  'games': ['id', 'nome', 'preco', 'plataforma', 'estoque'],
  'orders': ['id', 'user_id', 'valor_total', 'data_pedido', 'status'],
  'session_logs': ['id', 'user_name', 'login', 'logout'] // Exibe nome do usuário ao invés de user_id
};

// ---------------------------------------------------
// CARREGAR DADOS DA SECÇÃO
// ---------------------------------------------------
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
  const tableEl = document.getElementById(tableId);

  if (!tableEl) return;

  const res = await fetch(`../php/API.php?action=read&table=${NomeTabela}`);
  const data = await res.json();

  tableEl.innerHTML = "";

  if (data.error) return alert(data.error);
  if (!data.length) {
    tableEl.innerHTML = "<tr><td>Sem dados</td></tr>";
    return;
  }

  const specificColumns = sectionColumns[section];
  tableHeaders = specificColumns || Object.keys(data[0]);

  const hasActions = section !== 'session_logs';

  let headerRow =
    "<tr>" +
    tableHeaders.map(h => `<th>${h}</th>`).join("") +
    (hasActions ? "<th>Ações</th>" : "") +
    "</tr>";

  tableEl.innerHTML = headerRow;

  data.forEach(row => {
    const rowHTML = tableHeaders.map(h => `<td>${row[h] ?? ''}</td>`).join("");

    const actionsHTML = hasActions ? `
      <td class="actions">
        <button class="btn-icon btn-edit" title="Editar" onclick="editRow(${row.id})">
          <i class="fa-solid fa-pen-to-square"></i>
        </button>
        <button class="btn-icon btn-delete" title="Excluir" onclick="deleteRow(${row.id})">
          <i class="fa-solid fa-trash-can"></i>
        </button>
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

// ---------------------------------------------------
// CRIA CAMPOS DO FORMULÁRIO (MODAL GLOBAL)
// ---------------------------------------------------
function buildFormFields(sampleRow) {
  const container = document.getElementById("formFields-global");
  if (!container) return;

  container.innerHTML = "";

  for (const key of Object.keys(sampleRow)) {
    if (key === "id" || key === "criado" || key === "atualizado") continue;

    container.innerHTML += `
      <label>${key}: <input type="text" name="${key}" id="field_${key}"></label><br>
    `;
  }
}

// ---------------------------------------------------
// LER FORMULÁRIO
// ---------------------------------------------------
function getFormData() {
  const data = {};
  const container = document.getElementById('formFields-global');

  const inputs = container.querySelectorAll('input[name]');
  inputs.forEach(input => {
    const name = input.getAttribute('name');
    data[name] = input.value;
  });

  if (currentId) data.id = currentId;

  return data;
}

// ---------------------------------------------------
// EDITAR REGISTRO
// ---------------------------------------------------
async function editRow(id) {
  try {
    const res = await fetch(`../php/API.php?action=read&table=${NomeTabela}`);
    const data = await res.json();

    const record = data.find(r => parseInt(r.id) === parseInt(id));
    if (!record) return alert("Registro não encontrado!");

    Object.keys(record).forEach(key => {
      const field = document.getElementById(`field_${key}`);
      if (field) field.value = record[key] ?? "";
    });

    currentId = id;

    document.getElementById("editGlobalTitle").innerText = `Editar ${currentSection}`;
    document.getElementById("editGlobalModal").style.display = "flex";

  } catch (err) {
    alert("Erro ao carregar registro.");
    console.error(err);
  }
}

// ---------------------------------------------------
// SALVAR (CREATE / UPDATE)
// ---------------------------------------------------
async function saveData(e) {
  e.preventDefault();

  const data = getFormData();
  const action = currentId ? 'update' : 'create';

  try {
    const res = await fetch(`../php/API.php?action=${action}&table=${NomeTabela}`, {
      method: 'POST',
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    });

    const result = await res.json();

    if (result.error) {
      alert(result.error);
    } else {
      document.getElementById("dataForm-global").reset();
      document.getElementById("editGlobalModal").style.display = "none";

      const successModal = document.getElementById("successModal");
      const successMessage = document.getElementById("successMessage");

      if (successModal && successMessage) {
        successMessage.textContent = "Registro guardado com sucesso!";
        successModal.style.display = "flex";
      }

      currentId = null;
      loadData();
    }

  } catch (err) {
    alert("Erro ao salvar registro.");
    console.error(err);
  }
}

// ---------------------------------------------------
// EXCLUIR
// ---------------------------------------------------
async function deleteRow(id) {
  const modal = document.getElementById("deleteGlobalModal");
  modal.style.display = "flex";

  const confirmBtn = modal.querySelector(".confirm");
  const newBtn = confirmBtn.cloneNode(true);
  confirmBtn.parentNode.replaceChild(newBtn, confirmBtn);

  newBtn.addEventListener("click", async () => {
    modal.style.display = "none";

    try {
      const res = await fetch(`../php/API.php?action=delete&table=${NomeTabela}`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id })
      });

      const result = await res.json();

      if (result.error) {
        alert(result.error);
      } else {
        alert("Registro excluído com sucesso!");
        loadData();
      }

    } catch (err) {
      alert("Erro ao excluir registro.");
      console.error(err);
    }

  });
}

// ---------------------------------------------------
// CANCELAR
// ---------------------------------------------------
function cancelEdit() {
  currentId = null;
  document.getElementById("dataForm-global").reset();
  document.getElementById("editGlobalModal").style.display = "none";
}

// ---------------------------------------------------
// EVENTOS
// ---------------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("dataForm-global");
  if (form) form.addEventListener("submit", saveData);
});

document.addEventListener("DOMContentLoaded", () => {

    const successOkBtn = document.getElementById("successOkBtn");
    if (successOkBtn) {
        successOkBtn.addEventListener("click", () => {
            const successModal = document.getElementById("successModal");
            if (successModal) {
                successModal.style.display = "none";
            }
        });
    }

    // Fechar clicando no fundo (background)
    const successModal = document.getElementById("successModal");
    if (successModal) {
        const bg = successModal.querySelector(".modal-background");
        if (bg) {
            bg.addEventListener("click", () => {
                successModal.style.display = "none";
            });
        }
    }
});
