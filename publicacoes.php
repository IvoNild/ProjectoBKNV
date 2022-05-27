<?php 
    session_start();
    if(!isset($_SESSION['userData'])):
        header('location:login.php');
    endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Me encontra - Publicações</title>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.css">

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fontawesome/css/v4-shims.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="NoRefreshJS/publicacoes.js"></script>
</head>

<body>

    <div id="main">

    </div>

    <main>
        <!--Barra de navegação apenas para mobile-->
        <nav class="navbar expand-sm bg-light fixed-top" id="navbar" style="border-bottom: 1px solid rgb(211,211,211);">
            <div class="container">
                <a href="home.php" class="nav-link nav-brand text-primary">Me.Encontra <span
                        class="fa fa-map-signs"></span>
                </a>
                <a class="py-2 px-4" data-bs-toggle="offcanvas" href="#offcanvas-start" role="button"
                    aria-controls="offcanvasExample">
                    <span class="fa fa-th-large"></span>
                </a>
            </div>
        </nav>
        <!--Menu de navegação apenas para mobile-->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-start"
            aria-labelledby="offcanvasExampleLabel">
            <!--Cabeçalho da barra de navegação-->
            <div class="offcanvas-header py-2">
                <a href="home.php" class="nav-link nav-brand text-primary">Me.Encontra <span
                        class="fa fa-map-signs"></span>
                </a>
                <button type="button" class="btn text-primary" data-bs-dismiss="offcanvas" aria-label="Close">
                    <span class="fa fa-times"></span>
                </button>
            </div>
            <!--Body da barra de navegação-->
            <div class="offcanvas-body pt-4 p-0 mb-0 " style="overflow-x: hidden;">
                <div class="container">
                    <!--Área para usuário logado-->
                    <!--Linha>coluna da imagem de perfil-->
                    <div class="row justify-content-center mb-0">
                        <div class="col-5 text-center">
                            <figure class="perfil-img mb-2">
                                <img src="img/<?php echo $_SESSION['userData']['perfilPicture']; ?>" class=""
                                    alt="imagem de perfil">
                            </figure>
                        </div>
                    </div>
                    <!--Linha>Colunas do nome de perfil e interesse/inetressados-->
                    <div class="row text-center mt-0">
                        <div class="col-12 ">
                            <a href="#" class="nav-link pt-0 p-1"><?php echo $_SESSION['userData']['name'] ?></a>
                        </div>
                        <div class="col-12 m-0">
                            <a href=""
                                class="nav-link text-secondary py-0" data-bs-toggle="modal" href="#modalInteresses" data-bs-target="#modalInteresses">Interesses 0</a>
                        </div>
                        <div class="col-12 m-0 text-secondary">
                            <a href=""class="nav-link text-secondary py-0 pb-3" data-bs-toggle="modal" href="#modalInteressados" data-bs-target="#modalInteressados">Interessados 0</a>
                        </div>
                    </div>
                </div>
                <!--Área do menu-->
                <div class="">
                    <div class="row ">
                        <ul class="list-group text-center ">
                            <li><a href="perfil.php" class="list-group-item ">Perfil</a></li>
                            <li><a href="publicar.php" class="list-group-item ">Evento/Local</a></li>
                            <li><a href="publicacoes.php" class="list-group-item active">Publicações</a></li>
                            <li><a href="" class="list-group-item ">Mapa <span class="fa fa-map-marker"></span></a></li>
                            <li><a href="sessao.php?close" class="list-group-item text-primary "> Sair <span
                                class="fa fa-sign-out"></span> </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Footer do Menu de navegação-->
            <div class="offcanvas-footer p-2">
                <div class="container text-center">
                    <a href="" class="nav-link text-primary">Políticas e Termos de uso</a>
                </div>
            </div>
        </div>

        <!-- Modal interesses -->
        <div class="modal fade " id="modalInteresses" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pessoas do seu interesse</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="height: 300px; height: auto;">

                        <form action="" class="mb-3 pb-3" style="border-bottom: 1px dashed rgb(211,211,211);">

                            <div class="input-group">
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="Pesquise por nome....">
                                <button class="btn btn-primary">
                                    <span class="fa fa-search"></span>
                                </button>
                            </div>

                        </form>

                        <div class="row" id="user-list">
                            <div class="col-sm-4 col-md-3  text-center py-2">
                                <figure style="width: 50px; height: 50px; display: inline-block;" class="m-0">
                                    <img src="img/linkedin-sales-navigator-pAtA8xe_iVM-unsplash.jpg" alt=""
                                        class="w-100 h-100">
                                </figure>
                                <br>
                                <a href="" style="text-decoration:none; font-size: 13px;">Edivaldo Boss</a>
                                <p class="m-0" style="font-size: 12px;">987654321</p>
                            </div>

                            <div class="col-sm-4 col-md-3 text-center py-2">
                                <figure style="width: 50px; height: 50px; display: inline-block;" class="m-0">
                                    <img src="img/linkedin-sales-navigator-pAtA8xe_iVM-unsplash.jpg" alt=""
                                        class="w-100 h-100">
                                </figure>
                                <br>
                                <a href="" style="text-decoration:none; font-size: 13px;">Edivaldo Boss</a>
                                <p class="m-0" style="font-size: 12px;">987654321</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal interessado -->
        <div class="modal fade " id="modalInteressados" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pessoas interessadas em você</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="height: 300px; height: auto;">

                        <form action="" class="mb-3 pb-3" style="border-bottom: 1px dashed rgb(211,211,211);">

                            <div class="input-group">
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="Pesquise por nome....">
                                <button class="btn btn-primary">
                                    <span class="fa fa-search"></span>
                                </button>
                            </div>

                        </form>

                        <div class="row" id="user-list">
                            <div class="col-sm-4 col-md-3  text-center py-2">
                                <figure style="width: 50px; height: 50px; display: inline-block;" class="m-0">
                                    <img src="img/linkedin-sales-navigator-pAtA8xe_iVM-unsplash.jpg" alt=""
                                        class="w-100 h-100">
                                </figure>
                                <br>
                                <a href="" style="text-decoration:none; font-size: 13px;">Edivaldo Boss</a>
                                <p class="m-0" style="font-size: 12px;">987654321</p>
                            </div>

                            <div class="col-sm-4 col-md-3 text-center py-2">
                                <figure style="width: 50px; height: 50px; display: inline-block;" class="m-0">
                                    <img src="img/linkedin-sales-navigator-pAtA8xe_iVM-unsplash.jpg" alt=""
                                        class="w-100 h-100">
                                </figure>
                                <br>
                                <a href="" style="text-decoration:none; font-size: 13px;">Edivaldo Boss</a>
                                <p class="m-0" style="font-size: 12px;">987654321</p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!------------------------------------------------------------------------------------------------------------------------>

        <div class="container mt-4 mb-5">
            <!--Linha do (Logotipo, área de perfil, e botões de Entrar/Cadastrar) e (barra de pesquisa e Posts) -->
            <div class="row">
                <div class="col-lg-3" id="col-desktop-profile-logo">
                    <!--Linha do Logotipo, área de perfil, e links de Login/Cadastrar-->
                    <div class="row">
                        <!--Área de perfil de usuário-->
                        <div class="col-12 ">
                            <div class="card">
                                <div class="color-top bg-primary w-100"></div>
                                <div class="row justify-content-center" id="row-img-profile">


                                    <div class="col-lg-5 p-0 text-center">
                                        <figure class="img-perfil-desktop">
                                            <img src="img/<?php echo $_SESSION['userData']['perfilPicture']; ?>" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-12 text-center py-1">
                                        <a href="#" class="nav-link"><?php echo $_SESSION['userData']['name']; ?></a>
                                    </div>
                                </div>
                                <ul class="list-group text-center" id="profile-list">

                                    <li class="list-group-item"><a href="perfil.php" class="nav-link ">Perfil </a>
                                    </li>
                                    <li class="list-group-item"><a href="publicar.php" class="nav-link ">Evento/Local
                                        </a></li>
                                    <li class="list-group-item"><a href="publicacoes.php"
                                            class="nav-link ativo">Publicações
                                        </a></li>
                                    <li class="list-group-item"><a href="" class="nav-link">Mapa <span
                                                class="fa fa-map-marker"></span> </a></li>
                                    <li class="list-group-item text-secondary "> <a href=""
                                            class="nav-link text-secondary" data-bs-toggle="modal"
                                            href="#modalInteresses" data-bs-target="#modalInteresses">Interesses 0</a>
                                    </li>
                                    <li class="list-group-item text-secondary "><a href=""
                                            class="nav-link text-secondary" data-bs-toggle="modal"
                                            href="#modalInteressados" data-bs-target="#modalInteressados">Interessados
                                            0</a> </li>
                                    <li><a href="home.php" class="nav-link nav-brand text-primary">Me.Encontra <span
                                                class="fa fa-map-signs"></span>
                                        </a></li>
                                    <li class="list-group-item"><a href="sessao.php?close" class="nav-link"> Sair <span
                                                class="fa fa-sign-out"></span> </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="row">

                        <div class="col-12">

                            <form action="" id="queryForm">
                                <div class="input-group">
                                    <select name="eventType" class="form-select" id="eventType">
                                        <option value="">Eventos</option>
                                        <option value="Festa">Festa</option>
                                        <option value="Festival">Festival</option>
                                        <option value="Exposicao">Exposição</option>
                                        <option value="Feira">Feira</option>
                                        <option value="Outro">Outro</option>
                                    </select>
                                    <input type="date" name="eventDate" id="eventDate" class="form-control">



                                    <div class="input-group-text  btn btn-primary">
                                        <span class="fa fa-search"></span>
                                    </div>
                                </div>
                            </form>

                        </div>


                    </div>

                    <!--Linha>coluna-Posts-->
                    <div id="postList">
                        
                    </div>

            </div>
        </div>


    </main>

    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>


</body>

</html>