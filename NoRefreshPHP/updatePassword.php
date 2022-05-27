<?php 
	include_once '..\phpstuff\autoLoad.php';
    
    session_start();
	if(isset($_POST['meePassword'])):
        try
        {  
            
            if($_POST['currentPassword']!=$_SESSION['userData']['meePassWord'])
            {
                echo '<span class="text-danger">Password Errada, dados não podem ser alterados<span>';
                return;
            }

            TTransaction::open('meedb');
            $conn=TTransaction::get();
            $update = new TsqlUpdate;
            $update->setRowData('meePassword',$_POST['meePassword']);
            $update->setEntity('meeperson');
            $filter= new Tfilter('id','=',$_SESSION['userData']['id']);
            $criteria= new Tcriteria;
            $criteria->Add($filter);
            $update->setCriteria($criteria);
            if($conn->exec($update->getInstruction())==1)
            {
                $_SESSION['userData']['meePassWord']=$_POST['meePassword'];
                echo '<span class="text-primary">Password Alterada</span>';
            }
            else
            {
                echo '<span class="text-danger">Password não alterada</span>';
            }
            TTransaction::close();
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            TTransaction::roolback();
        }
	endif;

 ?>