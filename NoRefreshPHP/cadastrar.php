<?php include_once '..\phpstuff\autoLoad.php';

	if(isset($_POST['name'])):
		$select=new TsqlSelect;
		$select->setEntity("meeperson");

		$filter= new Tfilter('email','=',$_POST['email']);
		$filter2= new Tfilter('phone','=',$_POST['phone']);
		$criteria = new Tcriteria;
		$criteria->add($filter,Texpression::OR_OPERATOR);
		$criteria->add($filter2,Texpression::OR_OPERATOR);		

		$select->setCriteria($criteria);
		
		try
		{
			TTransaction::open('meedb');
			$conn=TTransaction::get();
			$result=$conn->query($select->getInstruction());
			
			if($result->rowCount()!=0)
			{
				echo '<span class="text-danger">Já existe uma conta com este email/telefone, é a tua conta e perdeste a senha?</span>';
				return;
			}
			$insert= new TsqlInsert;
			$insert->setEntity('meeperson');
			array_pop($_POST);
			foreach($_POST as $key=>$value)
			{
				$insert->setRowData($key,$value);
			}
			$result=$conn->exec($insert->getInstruction());
			if($result==1)
			{
                session_start();
				$result=$conn->query($select->getInstruction());
                $_SESSION['userData']=$result->fetch(PDO::FETCH_ASSOC);
                echo '<span class="text-primary">Cadastro Feito, Preparando as coisas para ti...</span>';
			}
			else
			{
				throw new Exception;
			}
			TTransaction::close();
		} catch (Exception $e)
		{
			echo "Algo errado aconteceu, fomos nós não você. Contacte-nos para a resolução";
			TTransaction::rollback();
		}
	endif;	
	