$(document).ready(function () {
  //Alterar os dados
  $('#form-update').submit(function (event) {
    var name = $('#name').val().trim()
    var password = $('#password').val().trim()
    var phone = $('#phone').val().trim()
    var message = ''
    if (name == '') message = '<span class="text-danger">Preencha o Nome</span>'
    else if (password == '' || password.length < 8)
      message =
        '<span class="text-danger">Preencha a password, tem que ter pelo menos 8 caracteres</span>'
    else if (phone == '')
      message =
        '<span class="text-danger">O número de telefone tem que ser preenchido</span>'
    if (message != '') {
      $('#updateResult').html(message)
      return false
    }

    var data = new FormData(this)
    $.ajax({
      data: data,
      url: 'NoRefreshPHP/perfilUpdateData.php',
      method: 'POST',
      contentType: false,
      processData: false,
      success: function (response) {
        $('#updateResult').html(response)
        $('#updateResult').fadeIn().html(response)
        setTimeout(function (response) {
          $('#updateResult').fadeOut().html(response)
        }, 4000)
        setTimeout(function () {
          location.reload()
        }, 4000)
      },
      error: function (errorMessage) {
        console.log(errorMessage)
      }
    })

    return false
  })

  //alterar a palavra passe
  $('#form-update-pass').submit(function () {
    var currentPassword = $('#currentPassword').val().trim()
    var confPassword = $('#confPassword').val().trim()
    var newPassword = $('#newPassword').val().trim()

    if (newPassword.length < 8) {
      $('#resultUpdatePass').html(
        '<span class="text-danger">Preencha o campo da nova password, contendo no mínimo 8 caracteres</span>'
      )
      return false
    } else if (confPassword == '') {
      $('#resultUpdatePass').html(
        '<span class="text-danger">Preencha o campo da password de confirmação</span>'
      )
      return false
    } else if (newPassword != confPassword) {
      $('#resultUpdatePass')
        .fadeIn()
        .html(
          '<span class="text-danger">A confirmação da nova password e a password são diferentes, tente novamente</span>'
        )
      setTimeout(function () {
        $('#resultUpdatePass')
          .fadeOut()
          .html(
            '<span class="text-danger">A confirmação da nova password e a password são diferentes, tente novamente</span>'
          )
      }, 5000)
      return false
    }
    $.ajax({
      url: 'NoRefreshPHP/updatePassword.php',
      method: 'POST',
      data: { meePassword: newPassword, currentPassword: currentPassword },
      success: function (response) {
        $('#resultUpdatePass').html(response)
        $('#resultUpdatePass').fadeIn().html(response)
        setTimeout(function () {
          $('#resultUpdatePass').fadeOut().html(response)
        }, 4000)
      }
    })
    return false
  })
})
