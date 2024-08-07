function login(){
    console.log("aqui")
    $.ajax({
        url: '?login',
        type: 'GET',
        data: {
            entrou: false
        },
    })
    .done(function(data) {
    })
    .fail(function(err) {
    });
}