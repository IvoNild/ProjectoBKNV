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

    <p>
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapsComment" role="button" aria-expanded="false" aria-controls="collapseComment">
          Link with href
        </a>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapsComment" aria-expanded="false" aria-controls="collapsComment">
          Button with data-bs-target
        </button>
      </p>
      <div class="collapse" id="collapsComment">
        <div class="card card-body">
          Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
      </div>


      <script src="bootstrap/js/jquery.js"></script>
      <script src="bootstrap5/js/bootstrap.min.js"></script>
    
</body>
</html>