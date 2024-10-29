async function salvarPlaylist() {
  event.preventDefault();
  let form = document.getElementById('form-playlist');
  let formData = new FormData(form);
  try {
    let url = '../src/playlistManager.php?option=save';
    const response = await fetch(url, {
      method: 'POST',
      body: formData
    });

    if (!response.ok) {
      throw new Error('Erro na requisição');
    }

    const data = await response.json();
    console.log('Playlist salva com sucesso:', data);
  } catch (error) {
    console.error('Erro ao salvar playlist:', error);
  }
}
