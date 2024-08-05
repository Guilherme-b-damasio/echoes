function login(){
    console.log("aqui")
    $.ajax({
        url: 'spotify-teste/public/login',
        type: 'POST',
        data: {
            entrou: false
        },
    })
    .done(function(data) {
    })
    .fail(function(err) {
    });
}