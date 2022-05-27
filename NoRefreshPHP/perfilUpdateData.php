<?php 
	include_once '..\phpstuff\autoLoad.php';
    session_start();
	if(isset($_POST['name'])):
		try
		{			
			if($_POST['password']!=$_SESSION['userData']['meePassWord'])
			{
				echo '<span class="text-danger">Senha errada, alteração não pode ser feita!<span>';
				return;
			}
            
            TTransaction::open('meedb');
			$conn=TTransaction::get();
			

			$filter3= new Tfilter('id','=',$_SESSION['userData']['id']);
			$update= new TsqlUpdate;
			$update->setEntity('meeperson');
			$criteria= new Tcriteria;
			$criteria->add($filter3);
			$update->setCriteria($criteria);
			
			//remover os dois extremos(primeiro e último)
			array_pop($_POST);
            $_POST['perfilPicture']=$_SESSION['userData']['perfilPicture'];


			if(isset($_FILES['perfilPicture']))
			{
				Upload::SetAvailablesFormat('jpg','jpeg','png','gif');
				$uploadResult=Upload::Upload('perfilPicture','../img');
				if($uploadResult===true):
					$_POST['perfilPicture']=Upload::$uploadedFile;
				endif;
					
			}
			/*
			if(isset($_FILES['perfilPicture']) && $_FILES['perfilPicture']['name']!="")
			{
				$_POST['perfilPicture']=Upload::Upload('perfilPicture','../img');

				if($_POST['perfilPicture']==-1 || $_POST['perfilPicture']==NULL)
				{
					echo 'Foto não Alterada, manter-se-a a última foto vista<br>';
				}
			}*/ 

			foreach($_POST as $key=>$value)
			{
				$update->setRowData($key,$value);
			}

			if($conn->exec($update->getInstruction())==1)
			{
                $_SESSION['userData']['name']=$_POST['name'];
                $_SESSION['userData']['phone']=$_POST['phone'];
                $_SESSION['userData']['perfilPicture']=$_POST['perfilPicture'];
                echo '<span class="text-primary">Dados Alterados Com Exito</span>';
			}
            else
            {
                echo '<span class="text-danger">Dados Não Alterados</span>';
            }
			TTransaction::close();	
		} catch (Exception $e)
		{
			echo '<span class="text-danger">Algo errado aconteceu, fomos nós não você. Contacte-nos para a resolução';
			TTransaction::rollback();
		}
	endif;	
 ?>