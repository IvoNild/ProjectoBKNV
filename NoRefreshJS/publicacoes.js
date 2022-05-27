$(document).ready(function () {
  function makeQuery() {
    var eventType = $('#eventType').val()
    var eventDate = $('#eventDate').val()
    var event
    var eventLimit
    //testar se event Existe, existe se estiver na página inicial
    var testEvent = document.getElementById('event')
    var testEventLimit = document.getElementById('eventChoose')

    var data = { request: 'general' }

    if (!testEventLimit) {
      eventLimit = ''
    } else {
      eventLimit = $('#eventChoose').val()
      if (eventLimit.length > 0) data.eventLimit = eventLimit
    }

    if (!testEvent) {
      data.request = 'singular'
      event = ''
    } else {
      data.request = 'general'
      event = $('#event').val()
    }
    if (event.length > 0 && eventDate.length > 0 && eventType.length > 0) {
      data.event = event
      data.eventDate = eventDate
      data.eventType = eventType
    } else if (event.length > 0 && eventDate.length > 0) {
      data.event = event
      data.eventDate = eventDate
    } else if (event.length > 0 && eventType.length > 0) {
      data.event = event
      data.eventType = eventType
    } else if (eventDate.length > 0 && eventType.length > 0) {
      data.eventDate = eventDate
      data.eventType = eventType
    } else if (eventType.length > 0) data.eventType = eventType
    else if (eventDate.length > 0) data.eventDate = eventDate
    else if (event.length > 0) data.event = event

    $.ajax({
      method: 'POST',
      url: 'NoRefreshPHP/publicacoes.php',
      success: function (response) {
        $('#postList').html(response)
      },
      data: data
    })
  }
  makeQuery()
  function query() {
    makeQuery($('#eventDate').val(), $('#eventType').val())
  }
  //fazer uma requisição baseado no change event
  $('#eventType').change(query)
  $('#eventDate').change(query)
  $('#event').keyup(query)
  $('#eventChoose').change(query)
})
