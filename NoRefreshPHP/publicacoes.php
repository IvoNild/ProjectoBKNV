<?php include_once '..\phpstuff\autoLoad.php';

    session_start();
    if(isset($_POST['request'])):
        try
        {

            TTransaction::open('meedb');
            $conn=TTransaction::get();
            
            //definir se é uma query generica ou particular
            if($_POST['request']=='general'):
                $query="select * from meeeventDetail";

                if(isset($_POST['event'])):
                    $query.=" WHERE eventDescription like'%{$_POST['event']}%' || eventName like '%{$_POST['event']}%' || localDescription like '%{$_POST['event']}%' ";
                endif;
            else:
                $query="select * from meeeventDetail where meepersonID={$_SESSION['userData']['id']} ";
            endif;
            
            $glueQuery="";
            if(isset($_POST['eventDate']) && isset($_POST['eventType']))
                $glueQuery="&& (eventType ='{$_POST['eventType']}' || eventDate ='{$_POST['eventDate']}')";
            else if(isset($_POST['eventType']))
                $glueQuery=" && eventType ='{$_POST['eventType']}'";
            else if(isset($_POST['eventDate']))
                $glueQuery="&& eventDate ='{$_POST['eventDate']}'";
            
            //Caso em que se está na página de um outro usuário
            if(isset($_SESSION['otherUser'])):
                if(isset($_POST['event']))
                    $query.= " && meepersonID={$_SESSION['otherUser']}";
                else
                    $query.=" WHERE meepersonID={$_SESSION['otherUser']}";
            endif;
                    
            //Definir os outros quando se está em página de outrem
            if($_POST['request']=='general')
            {
                if(!isset($_SESSION['otherUser'])):
                    if(!isset($_POST['event']) && strlen($glueQuery)!=0):
                        $glueQuery="  WHERE ".substr($glueQuery,3);
                    endif;
                else:
                    //buscar eventos realizados ou por realizar
                    $currentDate=date('Y-m-d');
                    if(isset($_POST['eventLimit']) && $_POST['eventLimit']=="2")
                        $query.=" && eventDate < $currentDate";
                    else if($_POST['eventLimit']=="3")
                        $query.=" && eventDate > $currentDate";
                endif;
            }
            $query.="  ".$glueQuery;

            $query.=" order by eventDate ,eventTime desc";
            //var_dump($query);
            $result=$conn->query($query);
            
            if($data=$result->fetch(PDO::FETCH_ASSOC)):

                /* Aqui  tem a listagem de todos os elementos da lista de evento */
                while($data):?>

                    <div class="row mt-4">

                    
                        <div class="col-12">

                        
                            <div class="post card px-3 py-4 pb-1">
                                <!--Linha>Imagem de perfil e nome de usuário-->
                                <div class="row align-items-center">
                                    <div class="col-md-3 col-4 text-end" id="img-profile-col">
                                        <figure class="img-profile-post m-0">
                                            <img src="img/<?php echo $data['perfilPicture']; ?>" alt="Imagem">
                                        </figure>
                                    </div>
                                    <div class="col-8  p-0 " id="username-profile-col">
                                        <h3 class="h6 m-0"><a href="perfilOther.php?meeperson=<?php echo $data['meepersonID']; ?>" class="nav-link ps-0 pe-0 pb-1"><?php echo $data['meepersonName']; ?></a>
                                        </h3>
                                        <p style="font-size: 12px;"><span class="fa fa-clock text-secondary"></span>
                                        <?php //Aqui  vai o tempo ?>
                                        <?php $releaseDateTime=new DateTime($data['eventDateTimeRelease']);
                                                $currentDateTime = new DateTime(date('Y-m-d H:i:s'));
                                                $spendTime=$releaseDateTime->diff($currentDateTime);
                                        ?>
                                        <?php echo $spendTime->h.':'.$spendTime->i.'min'; ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="px-4">

                                    <!--Linha>coluna data do evento e icones de mídia-->
                                    <div class="row mt-3 " id="line-date-and-incon-media">
                                        <div class="col-6" id="col-date">
                                            <p class=" text-secondary mb-2"> <span class="fa fa-calendar"></span>
                                                <?php //Aqui vai a data do evento e hora de inicio ?>
                                                <?php echo $data['eventDate'].', '.$data['eventTime']; ?>
                                            </p>
                                        </div>
                                        <div class="col-6 text-end" id="col-icon-media">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#ImgModal<?php echo $data['id']; ?>">
                                                <span class="fa fa-camera-retro"></span>
                                            </button>
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#VideoModal<?php echo $data['id']; ?>">
                                                <span class="fa fa-play-circle"></span>
                                            </button>
                                        </div>
                                    </div>

                                    <!--Título do Evento-->
                                    <h4 class="h5 mt-3" id="event-title"><?php echo $data['eventName']; ?></h4>

                                    <!--Parágrafo do Ingresso-->
                                    <p id="ingress-buy">Ingresso <?php echo $data['ticketPrice']; ?>
                                        <button type="button" id="btn-buy" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Ingresso<?php echo $data['id']; ?>">
                                                Comprar
                                        </button>
                                        <?php //Aqui vão os ingressos vendidos ?>
                                            Ingressos vendidos:<?php echo $data['ticketSold']; ?> / Ingressos restantes:<?php echo $data['ticketCount']-$data['ticketSold'];
                                        if(($data['ticketCount']-$data['ticketSold']==0))
                                            echo ', Nenhum Ingresso sobrando';
                                        ?>
                                    </p>
                                    <!--Parágrafo de info. post-->
                                    <p class="text-justify pt-3" id="info-post">
                                            <?php echo $data['eventDescription']; ?>
                                            <!--<a href="#" class="" style="text-decoration: none;">Ler mais</a> -->
                                    </p>

                                    <!--Linha contacos(Localização e telefone)-->
                                    <div class="row mb-5">
                                        <p class="col-12 mb-0 text-secondary" style="font-size: 14px;"> <span
                                                class="fa fa-map-marker text-danger"></span>
                                                <?php //aqui  vai a descrição do local do evento?>
                                                <?php echo $data['localDescription']; ?>
                                        </p>
                                        <p class="col-12 text-secondary mb-0" style="font-size: 14px;"><span
                                                class="fa fa-phone text-success"></span> 
                                                <?php //aqui  vai o telefone ?>
                                                <?php echo $data['phone']; ?>    
                                        </p>


                                        <!--
                                       <p class="col-12 text-end mb-2" style="font-size: 13px;">
                                            <a href="" class="text-secondary" style="text-decoration: none;">
                                                <span class="fa fa-share" style="font-size: 11px;"></span> Partilhar
                                            </a> -->
                                        </p>

                                    </div>
                                    <?php //aqui busca-se a quantidade de gente que mostrou interesse e de gente que comentou
                                    //calcular a quantidade de interesasdos
                                    
                                    $query="select count(id) as qtd from meeeventpersoninterest where meeevent={$data['id']}";

                                    $result1=$conn->query($query)->fetch(PDO::FETCH_ASSOC);
                                    $qtdInterest=$result1['qtd'];
                                    //calcular a quantidade de comentários
                                    $query="select count(id) as qtd from meeeventpersoncomment where meeevent={$data['id']};";

                                    $result1=$conn->query($query)->fetch(PDO::FETCH_ASSOC);
                                    $qtdComment=$result1['qtd'];

                                    ?>

                                    <!--Footer do post-->

                                    
                                    <!--<div class="post-footer mt-0 py-3">
                    
                                        <ul class="list-post-footer ">
                                            <li><a href="#" class="text-secondary" data-bs-toggle="modal"
                                                    href="#interessados<?php echo $data['id']; ?>" data-bs-target="#interessados<?php echo $data['id']; ?>">
                                                    <span class="fa fa-map-pin"></span> 
                                                    <?php //aqui  a quantidade de interessados ?>
                                                    <?php echo $qtdInterest; ?></a> 
                                                    <a href="" id="<?php echo $data['id']; ?>"
                                                     class="text-secondary interested">Interessado</a>  </li>
                                            <li class="ms-3"><a href="#collapsComment<?php echo $data['id']; ?>" class="text-secondary" data-bs-toggle="collapse"  role="button" aria-expanded="false" aria-controls="collapseComment"> <span
                                                        class="fa fa-comment"></span> 
                                                        <?php echo $qtdComment; ?>
                                                    </a></li>
                                        </ul>

                                    </div>-->

                                    
                                </div>
                            </div>
                    

                        </div>
                    
                    </div>
                        <!-------------------- -->
                    <!-- Modal comprar ingresso -->
                    <div class="modal fade" id="Ingresso<?php echo $data['id']; ?>" data-bs-backdrop="static" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header py-2">
                                    <h5 class="modal-title h6" id="exampleModalLabel"> Comprar Ingresso <span
                                            class="fa fa-ticket"></span> </h5>
                                    <button type="button" class="btn text-primary" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span class="fa fa-times"></span>
                                    </button>
                                </div>
                                <div class="modal-body p-0">
                                    
                                        <form action="" class="p-4">

                                            <input type="number" name="" class="form-control mb-2" placeholder="Quantidade" required>
                                            <input type="text" name="" id="" class="form-control mb-2" placeholder="Campo reservado para pagamento" required>
                                            <input type="text" name="" id="" class="form-control mb-2" placeholder="Campo reservado para pagamento" required>

                                            <input type="submit" value="Comprar" class="btn btn-primary w-100 mb-4">

                                        </form>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal Interessados-post -->
                    <div class="modal fade" id="interessados<?php echo $data['id']; ?>" data-bs-backdrop="static" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" id="modalContent">
                                <div class="modal-header py-2">
                                    <h5 class="modal-title h6" id="exampleModalLabel"><span
                                            class="fa fa-map-pin"></span> <?php echo $qtdInterest; ?></h5>
                                    <button type="button" class="btn text-primary" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span class="fa fa-times"></span>
                                    </button>
                                </div>
                                <div class="modal-body p-0" id="modalBody">
                                    <div class="row pt-2 pb-0 px-4 align-items-center"
                                        style="border-bottom: 1px solid rgb(211,211,2111);">
                                        <div class="col-3 ">
                                            <figure style="width: 45px; height: 45px;">
                                                <img src="img/linkedin-sales-navigator-pAtA8xe_iVM-unsplash.jpg"
                                                    class="w-100 h-100" alt="" style="object-fit: cover;">
                                            </figure>
                                        </div>
                                        <div class="col-9 ">
                                            <h5 class="py-0  mb-0" style="font-size: 14px;"> <a href="#"
                                                    style="text-decoration: none;">Edivaldo Boss</a> </h5>
                                            <p class="py-0 " style="font-size: 13px;">987654321</p>
                                        </div>
                                    </div>



                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal img-post -->
                    <div class="modal fade" id="ImgModal<?php echo $data['id']; ?>" data-bs-backdrop="static" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header py-2">
                                    <h5 class="modal-title h6" id="exampleModalLabel"><span
                                            class="fa fa-camera-retro"></span> <?php echo $data['eventName']; ?></h5>
                                    <button type="button" class="btn text-primary" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span x class="fa fa-times"></span>
                                    </button>
                                </div>
                                <div class="modal-body p-0">
                                    <img src="img/<?php echo $data['photo'];  ?>" class="img-fluid "
                                        alt="Any Event" id="img-post-theme">
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal img-post -->
                    <div class="modal fade" id="VideoModal<?php echo $data['id']; ?>" data-bs-backdrop="static" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header py-2">
                                    <h5 class="modal-title h6" id="exampleModalLabel"><span
                                            class="fa fa-play-circle"></span><?php echo $data['eventName']; ?> </h5>
                                    <button type="button" class="btn text-primary" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span class="fa fa-times"></span>
                                    </button>
                                </div>
                                <div class="modal-body p-0">

                                    <div class="embed-responsive embed-responsive-16by9 mt-3">
                                        <video
                                            alt="Video"
                                            src="img/<?php echo $data['video']; ?>"
                                            controls="controls" class="embed-responsive-item w-100">
                                        </video>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                        <!--Área comentários - Post -->
                    <div class="collapse mt-1" id="collapsComment<?php echo $data['id']; ?>">

                        <div class="card card-body" id="comments-area<?php echo $data['id']; ?>">    
                                <form id="formComment" action="#" class=" mt-2 mb-4">
                                    
                                    <textarea name="comment" id="comment"  cols="30" rows="3" class="form-control mb-2" placeholder="Escreva aqui seu comentário"></textarea>
                                <input type="submit" id="sendComment" name="sendComment" value="Comentar" class="btn btn-primary">
                                    <input type="number" id="meeevent" name="meeevent" hidden value="<?php echo $data['id']; ?>">
                                    <input type="number" id="meepersonComment" name="meepersonComment" hidden value="<?php echo $_SESSION['userData']['id']; ?>">
                                    
                                    <p id="result" >   
                                </form>

                                <div class="comments">
                                    <a href="#" class="nav-link p-0">João de almeida</a>
                                    <p class="m-0">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere voluptatum corporis.
                                    </p>
                                    <p class="text-secondary" style="font-size: 10px;" >20 minutos atrás</p>
                                </div>
                        </div>
                    </div>
<?php

                    $data=$result->fetch(PDO::FETCH_ASSOC);
                endwhile;
            else:
                echo '<h2 class="text-white text-center" style="margin-top:200px">Nenhum Evento encontrado</h2>';
            endif;

            TTransaction::close();
        }
        catch(Exception $e)
        {
            echo "Algo errado aconteceu, fomos nós não você. Contacte-nos para a resolução";
			TTransaction::rollback();
        }
    endif;

?>