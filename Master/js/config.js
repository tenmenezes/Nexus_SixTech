// Configurações globais da aplicação
export const CONFIG = {
  API_BASE_URL: '../../php',
  
  // Mensagens de validação
  VALIDATION_MESSAGES: {
    required: field => `Campo ${field} é obrigatório`,
    invalid: field => `Campo ${field} está em formato inválido`,
    success: 'Operação realizada com sucesso',
    error: 'Ocorreu um erro. Tente novamente.'
  },

  // Timeouts e delays
  TIMEOUTS: {
    MESSAGE_DURATION: 3000,
    DEBOUNCE_SEARCH: 300
  },

  // Regex de validação
  VALIDATION_PATTERNS: {
    email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    cpf: /^\d{3}\.\d{3}\.\d{3}-\d{2}$/,
    cep: /^\d{5}-\d{3}$/,
    celular: /^\+55 \(\d{2}\) \d{4,5}-\d{4}$/
  }
};