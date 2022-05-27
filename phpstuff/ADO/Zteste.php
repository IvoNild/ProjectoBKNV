<?php 

function __autoLoad($classe)
{
	if(file_exists("$classe.class.php"))
		include_once "$classe.class.php";
	elseif(file_exists("log/$classe.class.php"))
		include_once "log/$classe.class.php";
	elseif(file_exists("dataBase/$classe.class.php"))
		include_once "dataBase/$classe.class.php";
}

try
{
	$insert= new TsqlInsert;
	$insert->setRowData('nome','Benedito Ciloca Ricardo Baptista');
	$insert->setRowData('profissao','Gestor e Faz Tudo');
	$insert->setRowData('descricao','tudo que precisas');
	$insert->setEntity('famosos');

	//conecta ao banco de dados
	Ttransaction::open('Zteste');
	$conn=Ttransaction::get();

	//fazer o registro de logg
	Ttransaction::setLogger(new TloggerHTML('log.html'));
	
	if(!$conn->query($insert->getInstruction()))
		throw new Exception('Erro! ao inserir registro');
	Ttransaction::log($insert->getInstruction());
	echo 'passou ca!';
	Ttransaction::close();
}
catch(Exception $e)
{
	echo $e->getMessage().'<br>';
}

	
 ?>