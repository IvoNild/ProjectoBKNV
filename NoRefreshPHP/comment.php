<?php include_once '..\phpstuff\autoLoad.php';
    session_start();
	if(isset($_POST['meeevent'])):
        var_dump($_POST);
				
		try
		{
			TTransaction::open('meedb');
			$conn=TTransaction::get();
		
		} catch (Exception $e)
		{
			echo "Algo errado aconteceu, fomos nós não você. Contacte-nos para a resolução";
			TTransaction::rollback();
		}
	endif;	
	