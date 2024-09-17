function setPlaylist(){
    fetch(`../src/search_songs.php`, {
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data) {
           
          }
        })
        .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}