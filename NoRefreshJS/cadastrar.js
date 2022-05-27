$(document).ready(function () {
  $('input:submit').click(function () {
    var message = ''
    var data = $('#formAdd').serializeArray()
    //vericar os campos
    for (var i = 0; i < data.length; i++) {
      var currentElement = data[i]
      if (currentElement.value.trim().length == 0) {
        message =
          '<span style="color:red">Preencha o campo :' +
          currentElement.name +
          '</span>'
        break
      }
    }
    if (message != '') {
      $('#result').html(message)
      return false
    }
    /*
    makeRequest({formIdentifier:$("#formaAdd"),url:'NoRefreshPHP/cadastrar.php',success:function(response){
        $("#result").html(response);
    },data:data});*/

    /*
    $.get('NoRefreshPHP/cadastrar.php',data).done(function(){
        console.log("Here result");
    }).fail(function(errorMessage){
        console.log(errorMessage);
    });*/

    $.ajax({
      type: 'POST',
      url: 'NoRefreshPHP/cadastrar.php',
      data: data,
      success: function (response) {
        $('#result').html(response)
        $('#result').fadeIn().html(response)
        setTimeout(function () {
          $('#result').fadeOut().html(response)
          location.reload()
        }, 4000)
      },
      error: function (errorMessage) {
        $('#result').html(
          '<span class="text-danger">Algum erro ocorreu,somos nós não tu!<span>'
        )
        console.log(errorMessage)
      }
    })
    return false
  })
})
