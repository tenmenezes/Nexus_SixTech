// 📦 js/dados.js

/**
 * Função assíncrona para buscar a lista de clientes/usuários do backend PHP.
 * A URL está configurada para buscar no seu arquivo get_clientes.php.
 * @returns {Promise<Array<Object>>} Uma promessa que resolve para um array de objetos de usuário.
 */
export async function getUsuarios() {
  try {
    // Note: Certifique-se de que o caminho está correto em relação ao seu HTML (userReports.html)
    const response = await fetch("./backend/get_clientes.php");

    if (!response.ok) {
      throw new Error(`Erro HTTP: ${response.status}`);
    }

    const data = await response.json();

    // O PHP retorna um array vazio ou os dados.
    if (data.error) {
      console.error("Erro retornado pelo PHP:", data.error);
      return []; // Retorna array vazio em caso de erro de DB
    }

    return data;
  } catch (error) {
    console.error("Erro ao buscar dados do PHP:", error);
    // Em caso de falha na requisição, retorne um array vazio
    return [];
  }
}