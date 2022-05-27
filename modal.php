<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.css">


</head>
<body>
    
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ImgModal">
    Launch demo modal
  </button>
  
<a href="" data-bs-toggle="modal" href="#ImgModal" data-bs-target="#ImgModal">
  modal link
</a>

  <!-- Modal -->
  <div class="modal fade " id="ImgModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 300px;">
          ...
        </div>
    
      </div>
    </div>
  </div>


  <!-- Vertically centered modal -->
<div class="modal-dialog modal-dialog-centered">
    ...
  </div>


  
  <script src="bootstrap/js/jquery.js"></script>
  <script src="bootstrap5/js/bootstrap.min.js"></script>

</body>
</html>