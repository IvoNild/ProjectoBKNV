<?php 
   include_once 'phpstuff\autoLoad.php';
   session_start();
   if(!isset($_SESSION['userData']) || !isset($_GET['meeperson'])):
       header('location:login.php');
   endif;
   try
   {
       Ttransaction::open('meedb');
       $conn=Ttransaction::get();
    
       $meeperson=$_GET['meeperson'];
       $query="select *from meeperson where id = $meeperson";
       $_SESSION['otherUser']=$_GET['meeperson'];
       $data=$conn->query($query)->fetch(PDO::FETCH_ASSOC);

       $query="select count(id) as countEvent from meeevent where meeperson=$meeperson";
       $statitic['countEvent']=$conn->query($query)->fetch(PDO::FETCH_ASSOC)['countEvent'];
       $currentDate=date('Y-m-d');
       $query="select count(id) as countPastEvent from meeevent where eventDate <$currentDate && meeperson=$meeperson";
       $statitic['countPastEvent']=$conn->query($query)->fetch(PDO::FETCH_ASSOC)['countPastEvent'];
       $query="select count(id) as countFutureEvent from meeevent where eventDate >= $currentDate && meeperson=$meeperson";
       $statitic['countFutureEvent']=$conn->query($query)->fetch(PDO::FETCH_ASSOC)['countFutureEvent'];
       Ttransaction::close();
   }catch(Exception $e)
   {
       echo $e->getMessage();
       Ttransaction::rollback();
       echo 'Something wentwrong, is not you it is us';
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Me encontra - Perfil</title>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.css">

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fontawesome/css/v4-shims.min.css">

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="NoRefreshJS/publicacoes.js"></script>
    <script type="text/javascript" scr="NoRefreshJS/otherSendInterest.js"></script>
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
                <a href="home.php" class="nav-link nav-brand text-primary">Me.Encontra <span class="fa fa-map-signs"></span>
                </a>
                <button type="button" class="btn text-primary" data-bs-dismiss="offcanvas" aria-label="Close">
                    <span class="fa fa-times"></span>
                </button>
            </div>

            <!--Body da barra de navegação-->
            <div class="offcanvas-body pt-4 p-0 mb-0">
                <div class="container">

                    <!--Área de info. para usuário visitante -->
                    <div class="info-visitante" style="display: none;">
                        <div class="col-12 mt-2">
                            <div class="container py-4">
                                <p class="">Estás a usar o <span class="text-primary">Me.Encontra</span> como visitante,
                                    <a href="">crie uma conta</a> ou faça o <a href="#">Login</a> se já tiver uma para
                                    usufruir de mais funcionalidades.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!--Área para usuário logado-->
                    <!--Linha>coluna da imagem de perfil-->
                    <div class="row justify-content-center mb-0">
                        <div class="col-5 text-center">
                            <a href="perfil.php">
                                <figure class="perfil-img mb-2">
                                    <img src="img/<?php echo $_SESSION['userData']['perfilPicture'];?>" class=""
                                        alt="imagem de perfil">
                                </figure>
                            </a>
                           
                        </div>
                    </div>

                    <!--Linha>Colunas do nome de perfil e interesse/inetressados-->

                    <div class="row text-center mt-0">
                        <div class="col-12 ">
                            <a href="perfil.php" class="nav-link pt-0 p-1"><?php echo $_SESSION['userData']['name'];?></a>
                        </div>
                        <div class="col-12 ">
                            <p class="m-0 text-secondary">Interessados 0</p>
                        </div>
                        <div class="col-12 m-0 text-secondary">
                            <a href="sessao.php?close" class="nav-link pt-0 pb-2 "> Sair <span class="fa fa-sign-out"></span> </a>
                        </div>
                    </div>
                </div>

                <!--Área do Mapa do Menu de navegação-->
                <div class="mapa">
                    <div class="row w-100 h-100 bg-primary align-items-center m-0">
                        <div class="col-12 text-center">
                            <h1>Mapa Aqui</h1>
                        </div>
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


        <!------------------------------------------------------------------------------------------------------------------------>

        <div class="container mt-4 mb-5">
            <!--Linha do (Logotipo, área de perfil, e botões de Entrar/Cadastrar) e (barra de pesquisa e Posts) -->
            <div class="row">
                <div class="col-lg-3" id="col-desktop-profile-logo">
                    <!--Linha do Logotipo, área de perfil, e links de Login/Cadastrar-->
                    <div class="row">
                        <div class="col-12">
                            <div class="card text-center">
                                <div class="py-4 pt-5 px-4">
                                    <h1 class="h5 text-primary mb-0"> <a href="home.php"
                                            style="text-decoration: none;"> <span class="fa fa-map-signs"></span> <br>
                                            Me.Encontra</a></h1>
                                    <p>Encontre qualquer evento do seu interesse</p>
                                </div>
                                <div class="footer-area-logo py-2">
                                    <a href="" class="nav-link text-primary">Políticas e Termos de uso</a>
                                </div>
                            </div>
                        </div>

                        <!--Área de info. para usuário visitante -->
                        <div class="col-12 mt-2" style="display:none">
                            <p class="text-white" style="text-align: justify;">Estás a usar o <span
                                    class="text-primary">Me.Encontra</span> como
                                visitante, <a href="">crie uma conta</a> ou faça o <a href="#">Login</a> se já tiver uma
                                para usufruir de mais funcionalidades.</p>
                        </div>

                        <!--Área de perfil de usuário-->
                        <div class="col-12 mt-2 mb-3" style="display: block;">
                            <div class="card">
                                <div class="color-top bg-primary w-100"></div>
                                <div class="row justify-content-center" id="row-img-profile">
                                    <div class="col-lg-5 p-0 text-center">
                                        <figure class="img-perfil-desktop">
                                            <img src="img/<?php echo $_SESSION['userData']['perfilPicture'];?>" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-12 text-center py-1">
                                        <a href="perfil.php" class="nav-link"><?php echo $_SESSION['userData']['name']?></a>
                                    </div>
                                </div>
                                <ul class="list-group text-center" id="profile-list">
                                    <li class="list-group-item text-secondary ">Interessados 0</li>
                                    <li class="list-group-item"><a href="" class="nav-link py-1">Mapa <span
                                                class="fa fa-map-marker"></span> </a></li>
                                    <li class="list-group-item"><a href="sessao.php?close" class="nav-link py-1">Sair <span
                                                class="fa fa-sign-out"></span> </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Coluna barra de pesquisa e posts-->
                <div class="col-lg-7">

                    <div class="row">

                        <!--Coluna info perfil-other-->
                        <div class="col-12">
                            <div class="card p-3">

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <figure style="width: 100px; height: 100px; display: inline-block;"
                                            class="mb-0">
                                            <img src="img/<?php echo $data['perfilPicture'];?>" alt=""
                                                class="w-100 h-100">
                                        </figure>

                                    </div>

                                    <div class="col-12 text-center">
                                        <h2 class="text-primary"><?php echo $data['name'];?></h2>
                                        <p class="m-0"><?php echo $data['phone'];?></p>
                                        <p class="m-0"><?php echo $data['email'];?></p>
                                        <p class="m-0">Eventos Publicados:<?php echo $statitic['countEvent'] ?></p>
                                        <p class="m-0">Eventos Realizados:<?php echo $statitic['countPastEvent'] ?></p>
                                        <p>Eventos por realizar:<?php echo $statitic['countFutureEvent'] ?></p>
                                    </div>

                                    <div class="col-12 ps-4">
                                        <a href="" personID="<?php echo $_SESSION['otherUser']; ?>" id="sendInterest" style="text-decoration: none;" class="text-secondary"> <span
                                                class="fa fa-map-pin"></span> Interesse </a>
                                        <p class=" text-primary"><span class="fa fa-map-pin"></span> Interessados:
                                            0</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!--Coluna barra de pesquisa-->
                        <div class="col-12 mt-2">

                            <form action="">
                                <div class="input-group">
                                    <input type="text" name="event" id="event" class="form-control" placeholder="Local ou nome...">
                                    <select name="eventChoose" id="eventChoose" class="form-select">
                                        <option value="1">Todos os Eventos</option>
                                        <option value="2">Eventos realizados</option>
                                        <option value="3">Eventos por realizar</option>
                                    </select>
                                    <input type="date" name="eventDate" id="eventDate" hidden>
                                    <select name="eventType" id="eventType" class="form-select">
                                        <option value="">Evento</option>
                                        <option value="Festa">Festa</option>
                                        <option value="Exposicao">Exposição</option>
                                        <option value="Festival">Festival</option>
                                        <option value="Feira">Feira</option>
                                    </select>
                                    <div class="input-group-text btn btn-primary">
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
        </div>


    </main>

    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>


</body>

</html>