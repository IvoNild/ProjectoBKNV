<?php
    session_start();
    if(isset($_SESSION['userData'])):
        header('location:home.php');
        exit;
    endif;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Me Encontra-Cadastro</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="NoRefreshJS/cadastrar.js"></script>
</head>
<body>
    <div id="container-main">
        <div class="opac d-flex align-items-center py-5">
            <div class="container">
                <div >
                    <div class="row ">
    
                        <div class="col-md-6 text-white pt-5">
                            <p class="mb-0 pt-5">Bem-vindo ao</p>
                            <h1>Me Encontra</h1>
                            <p class="text-justify">O Me Encontra é um website de publicidade de eventos, onde você pode encontrar eventos de terceiros, ou publicitar seus eventos para que alcance um alto número de pessoas que estejam a procura de eventos como o seu.</p>
                             <!--<a href="#" class="btn btn-primary">Entrar como visitante</a>-->

                             <p>
                                 <span class="text-primary">Já tens uma conta?</span>
                                 <a href="login.php" class="ml-2 btn btn-secondary">Entrar</a>
                             </p>
                        </div>
                        <div class="col-md-5 mt-3">
                            <form action="" method="POST" class="" id="formAdd">
                                <h2 class="h4 mb-4 text-white">Criar conta</h2>
                                <input type="text" name="name" id="name" placeholder="Nome" class="form-control mb-2 ">
                                <input type="email" name="email" id="email" placeholder="Email" class="form-control mb-2 ">
                                <input type="number" maxlength="9" minlength="9" name="phone" id="telefone" placeholder="Telefone" class="form-control mb-2 ">
                                <input type="password" name="meepassword" id="password" placeholder="Senha" class="form-control mb-2">
                                <input type="password" name="confPassword" id="confPassword" placeholder="Confirmar Senha" class="form-control mb-3">
                                <p id="result"></p>
                                <input type="submit"      value="Entrar" class="btn btn-primary form-control mb-4">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
     
</body>
</html>