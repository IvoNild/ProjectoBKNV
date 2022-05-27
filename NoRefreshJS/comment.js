$(document).ready(function () {
  var element = document.getElementById('sendElement')
  console.log('Hi World')

  $('#formComment').submit(function () {
    console.log('Here')
  }) 
  $('#sendComment').click(function () {
    console.log('Here like that man')
    var coment = $('#comment').val()
    var meeevent = $('#meevent').val()
    var data
    data.meeevent = meeevent
    data.comment = comment
    $.ajax({
      method: 'POST',
      url: 'NoRefreshPHP/comment.php',
      data: data,
      success: function (result) {
        $('#result').html(result)
      }
    })
    return false
  })
})
