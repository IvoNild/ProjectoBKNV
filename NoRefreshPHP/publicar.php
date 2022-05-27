<?php include_once '..\phpstuff\autoLoad.php';
    
    session_start();
	if(isset($_POST['eventName'])):		
		try
		{
            if($_POST['meePassword']!=$_SESSION['userData']['meePassWord'])
            {
                echo '<span class="text-danger">Senha Errada</span>';
                return;
            }
            unset($_POST['meePassword']);
			
			if(isset($_FILES['media']))
			{
				//Make Photo Upload
				Upload::SetAvailablesFormat('png','jpg','jpeg','gif');
				$uploadResult=Upload::Upload('media','../img',0);
				if($uploadResult===true):
					$_POST['photo']=Upload::$uploadedFile;
				else:
					echo $uploadResult;
					return;
				endif;
				//Make Video Upload
				if($_FILES['media']['name'][1]!=""):
					Upload::SetAvailablesFormat('mp4','mkv','m4a');
					$uploadResult=Upload::Upload('media','../img',1);
					if($uploadResult===true):
						$_POST['video']=Upload::$uploadedFile;
					
					else:
						echo $uploadResult;
						return;
					endif;
				endif;
					
			}
			
           
			TTransaction::open('meedb');
			$conn=TTransaction::get();

			$insert= new TsqlInsert;
			$insert->setEntity('meeevent');
			$_POST['meeperson']=$_SESSION['userData']['id'];
			foreach($_POST as $key=>$value)
			{
				$insert->setRowData($key,$value);
			}
			$result=$conn->exec($insert->getInstruction());
			if($result==1)
			{
          echo '<span class="text-primary">Publicação Feita<br>Processando Alteração<span>';
			}
			else
			{
                echo $insert->getInstruction();
				throw new Exception;
			}
			TTransaction::close();
		} catch (Exception $e)
		{
			echo '<span class="text-danger">Algo errado aconteceu, fomos nós não você. Contacte-nos para a resolução</span>';
			TTransaction::rollback();
		}
	endif;	
	