async function criarPlaylist() {
  const { value: playlistName } = await Swal.fire({
      title: 'Criar Playlist',
      input: 'text',
      inputLabel: 'Nome da Playlist',
      inputPlaceholder: 'Digite o nome da sua playlist',
      showCancelButton: true,
      confirmButtonText: 'Salvar',
      cancelButtonText: 'Cancelar',
      inputValidator: (value) => {
          if (!value) {
              return 'Você precisa digitar um nome!';
          }
      }
  });

  if (playlistName) {
      salvarPlaylist(playlistName);
  }
}

async function salvarPlaylist(playlistName) {
  try {
      const formData = new FormData();
      formData.append('playlist_name', playlistName);

      const response = await fetch('../src/playlistManager.php?option=save', {
          method: 'POST',
          body: formData
      });

      const data = await response.json();

      if (data && data.success) {
          Swal.fire({
              icon: 'success',
              title: 'Playlist criada com sucesso!',
              text: data.message
          });
      } else {
          Swal.fire({
              icon: 'error',
              title: 'Erro ao criar playlist',
              text: data.message || 'Tente novamente mais tarde.'
          });
      }
  } catch (error) {
      console.error('Erro ao salvar playlist:', error);
      Swal.fire({
          icon: 'error',
          title: 'Erro',
          text: 'Erro ao salvar a playlist. Verifique a conexão e tente novamente.'
      });
  }
}
