$(document).ready(function () {
  $('#formComment').submit(function (event) {
    var data = $('#formComment').serializeArray()

    console.log(data)
    $.ajax({
      method: 'POST',
      data: data,
      success: function (response) {
        $('#result').html(response)
      }
    })
    event.preventDefault()
  })
})
