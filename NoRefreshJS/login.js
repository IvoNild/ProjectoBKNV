$(document).ready(function () {
  $('#Entrar').click(function (event) {
    var userName = $('#userName').val().trim()
    var passWord = $('#password').val().trim()

    if (userName == '') {
      $('#result').html(
        '<span class="text-danger">Insira o número de telefone ou o email<span>'
      )
      return false
    } else if (password == '') {
      $('#result').html('<span class="text-danger">Insira a senha<span>')
      return false
    }

    var data = $('#form-login').serializeArray()
    $.ajax({
      data: data,
      method: 'POST',
      url: 'NoRefreshPHP/login.php',
      success: function (response) {
        $('#result').html(response)
        $('#result').fadeIn().html(response)
        setTimeout(function () {
          $('#result').fadeOut().html(response)
          console.log('walking here')
          location.reload()
        }, 4000)
      },
      error: function (error) {
        console.log('error :' + error)
      }
    })
    return false
  })
})
