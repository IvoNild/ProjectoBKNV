$(document).ready(function () {
  //Carregamento de estatistica sobre quantidade de eventos
  $.ajax({
    method: 'POST',
    url: 'NoRefreshPHP/EventStatistic.php',
    data: { request: 'statistic' },
    success: function (response) {
      $('#statisticDiv').html(response)
    }
  })

  $('#form').submit(function () {
    var message = ''
    var data = $('#form').serializeArray()
    //vericar os campos
    for (var i = 0; i < data.length; i++) {
      var currentElement = data[i]
      if (currentElement.value.trim().length == 0) {
        message = 'Preencha o campo :' + currentElement.name
        break
      }
    }
    if (message != '') {
      $('#result').html(message)
      return false
    }
    data = new FormData(this)
    $.ajax({
      method: 'POST',
      url: 'NoRefreshPHP/publicar.php',
      data: data,
      processData: false,
      contentType: false,
      success: function (response) {
        $('#result').html(response)
        $('#result').fadeIn().html(response)
        setTimeout(function () {
          $('#result').fadeOut().html(response)
        }, 1000)
        setTimeout(function () {
          location.reload()
          $('#form').trigger('reset')
        }, 1000)
      },
      error: function (errorMessage) {
        $('#result').html('Algum erro ocorreu,somos nós não tu!')
      }
    })
    return false
  })

  //alterar o status de venda pelo site
  function sellingHereFunction() {
    if ($('#sellingHere').val() == 'not') {
      $('#ticketPrice').prop('disabled', true)
      $('#ticketCount').prop('disabled', true)
      $('#ticketPrice').prop('name', '')
      $('#ticketCount').prop('name', '')
    } else {
      $('#ticketPrice').prop('disabled', false)
      $('#ticketCount').prop('disabled', false)
      $('#ticketPrice').prop('name', 'ticketPrice')
      $('#ticketCount').prop('name', 'ticketCount')
    }
  }
  //selling no inicio da página
  sellingHereFunction()
  $('#sellingHere').change(sellingHereFunction)
})
