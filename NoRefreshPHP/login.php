<?php include_once '..\phpstuff\autoLoad.php';
	session_start();
	if(isset($_POST['userName'])):
		$select=new TsqlSelect;
		$select->setEntity("meeperson");

		$filter= new Tfilter('email','=',$_POST['userName']);
		$filter2= new Tfilter('meepassword','=',$_POST['meepassword']);
		$filter3= new Tfilter('phone','=',$_POST['userName']);
		$criteria1 = new Tcriteria;
		$criteria2= new Tcriteria;
		$criteria= new Tcriteria;
		$criteria2->add($filter3,Texpression::AND_OPERATOR);
		$criteria2->add($filter2,Texpression::AND_OPERATOR);

		$criteria1->add($filter,Texpression::AND_OPERATOR);
		$criteria1->add($filter2,Texpression::AND_OPERATOR);		

		$criteria->add($criteria1,Texpression::OR_OPERATOR);
		$criteria->add($criteria2,Texpression::OR_OPERATOR);
		
		$select->setCriteria($criteria);
		
		try
		{
			TTransaction::open('meedb');
			
			$conn=TTransaction::get();
			$result=$conn->query($select->getInstruction());
			if($result->rowCount()==0)
			{
				echo '<span class="text-danger">Nome de usuario ou password errada</span>';
				return;
			}
			else
			{	
				$_SESSION['userData']=$result->fetch(PDO::FETCH_ASSOC);
				echo '<span class="text-primary">Login Processando...</span>';
			}
			TTransaction::close();
		} catch (Exception $e)
		{
			echo $e->getMessage();
			echo '<span class="text-danger">Algo errado aconteceu, fomos nós não você. Contacte-nos para a resolução</span>';
			TTransaction::rollback();
		}
	endif;
 ?>