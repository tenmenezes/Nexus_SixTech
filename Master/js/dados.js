import { CONFIG } from './config.js';

/**
 * Função assíncrona para buscar a lista de clientes/usuários do backend PHP.
 * @returns {Promise<Array<Object>>} Uma promessa que resolve para um array de objetos de usuário.
 * @throws {Error} Se houver erro na requisição ou dados inválidos
 */
export async function getUsuarios() {
  try {
    const response = await fetch(`${CONFIG.API_BASE_URL}/get_clientes.php`);

    if (!response.ok) {
      throw new Error(`Erro HTTP: ${response.status}`);
    }

    const data = await response.json();

    // Validação da estrutura dos dados
    if (!Array.isArray(data)) {
      if (data.error) {
        throw new Error(data.error);
      }
      throw new Error('Formato de dados inválido recebido do servidor');
    }

    // Validação básica dos campos obrigatórios
    const invalidUsers = data.filter(user => !user.id || !user.nome || !user.email);
    if (invalidUsers.length > 0) {
      console.warn('Alguns usuários possuem dados incompletos:', invalidUsers);
    }

    return data;
  } catch (error) {
    console.error("Erro ao buscar dados do PHP:", error);
    throw error; // Propaga o erro para tratamento na UI
  }
}

/**
 * Salva ou atualiza um usuário no backend
 * @param {Object} userData Dados do usuário para salvar
 * @returns {Promise<Object>} Usuário salvo com ID
 */
export async function saveUser(userData) {
  try {
    const response = await fetch(`${CONFIG.API_BASE_URL}/save_user.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(userData)
    });

    if (!response.ok) {
      throw new Error(`Erro HTTP: ${response.status}`);
    }

    return await response.json();
  } catch (error) {
    console.error("Erro ao salvar usuário:", error);
    throw error;
  }
}

/**
 * Remove um usuário do sistema
 * @param {number} userId ID do usuário a ser removido
 * @returns {Promise<void>}
 */
export async function deleteUser(userId) {
  try {
    const response = await fetch(`${CONFIG.API_BASE_URL}/delete_user.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id: userId })
    });

    if (!response.ok) {
      throw new Error(`Erro HTTP: ${response.status}`);
    }

    return await response.json();
  } catch (error) {
    console.error("Erro ao deletar usuário:", error);
    throw error;
  }
}