<?php 
	session_start();
	if(isset($_GET['access']) ):
	{
		if($_GET['access']=='create')
		{
			$_SESSION['email']=$_GET['email'];
			$_SESSION['telefone']=$_GET['phone'];
			$_SESSION['name']=$_GET['name'];
			header("location:home.php");
		}
		else if($_GET['access']=="in")
		{
			$_SESSION['userName']=$_GET['userName'];
			header('location:home.php');
		}
	}
	elseif(isset($_GET['close'])):
	{
		session_destroy();
		header("location:login.php");
	}
	else:
		header("location:login.php");
	endif;
 ?>