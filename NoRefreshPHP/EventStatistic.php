<?php include_once '..\phpstuff\autoLoad.php';

    session_start();
    if(isset($_POST['request'])):
        try
        {
            TTransaction::open('meedb');
            $conn=TTransaction::get();


            $result=$conn->query("select count(id) as qtd from meeevent where meeperson={$_SESSION['userData']['id']}")->fetch(PDO::FETCH_ASSOC);
            $result1=$conn->query("select count(id) as qtd from meeevent where meeperson={$_SESSION['userData']['id']} && eventDate<date('Y-m-d')")->fetch(PDO::FETCH_ASSOC);
            $result2=$conn->query("select count(id) as qtd from meeevent where meeperson={$_SESSION['userData']['id']} && eventDate>=date('Y-m-d')")->fetch(PDO::FETCH_ASSOC);
            
            echo '<h2>Eventos Publicados :'.$result['qtd'].'</h2>';
            echo '<p class="m-0">Eventos realizados: '.$result1['qtd'].'</p>';
            echo '<p>Eventos a realizar: '.$result2['qtd'].'</p>';
            TTransaction::close();
        }
        catch(Exception $e)
        {
            echo "Algo errado aconteceu, fomos nós não você. Contacte-nos para a resolução";
			TTransaction::rollback();
        }
    endif;

?>