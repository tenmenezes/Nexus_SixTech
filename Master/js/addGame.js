// Funções para o modal de adicionar jogo

function openAddGameModal() {
  console.log('Abrindo modal de adicionar jogo');
  const modal = document.getElementById('addGameModal');
  if (modal) {
    modal.style.display = 'flex';
  }
}

function closeAddGameModal() {
  console.log('Fechando modal de adicionar jogo');
  const modal = document.getElementById('addGameModal');
  if (modal) {
    modal.style.display = 'none';
    document.getElementById('addGameForm').reset();
  }
}

// Fecha o modal ao clicar no fundo
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('addGameModal');
  if (modal) {
    const background = modal.querySelector('.modal-background');
    if (background) {
      background.addEventListener('click', closeAddGameModal);
    }
  }

  // Manipula o envio do formulário
  const form = document.getElementById('addGameForm');
  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      console.log('Enviando formulário de adicionar jogo');

      const formData = new FormData(form);
      const data = {
        nome: formData.get('nome'),
        descricao: formData.get('descricao') || null,
        preco: parseFloat(formData.get('preco')),
        plataforma: formData.get('plataforma'),
        genero: formData.get('genero'),
        estoque: parseInt(formData.get('estoque')),
        img: formData.get('img')
      };

      console.log('Dados do jogo:', data);

      try {
        const response = await fetch('../php/API.php?action=create&table=games', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        });

        const result = await response.json();
        console.log('Resultado:', result);

        if (result.success) {
          // Mostra mensagem de sucesso
          const successModal = document.getElementById('successModal');
          const successMessage = document.getElementById('successMessage');
          
          if (successModal && successMessage) {
            successMessage.textContent = 'Jogo adicionado com sucesso!';
            successModal.style.display = 'flex';
          }

          closeAddGameModal();
          
          // Recarrega a tabela de jogos
          if (typeof loadDataForSection === 'function') {
            loadDataForSection('games');
          }
        } else {
          alert('Erro ao adicionar jogo: ' + (result.error || 'Erro desconhecido'));
        }
      } catch (error) {
        console.error('Erro:', error);
        alert('Erro ao adicionar jogo. Verifique o console para mais detalhes.');
      }
    });
  }
});
