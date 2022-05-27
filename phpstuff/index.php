<?php 

//ca eu faço o teste de todas as coisas que faço em php
include_once 'produto.class.php';
include_once 'bankaccount.class.php';


class nullFileException extends Exception{}
class nonFileException extends Exception{}
class readFileException extends Exception{}


function openFile($file=null)
{
	if(!$file)
		throw new nullFileException('Argumento nulo passado como parametro');
	elseif(!is_file($file))
		throw new nonFileException('Argumento passado não é um arquivo');
	elseif(!$content=file($file))
		throw new readFileException('Impossível ler o arquivo');
	else
		;
	
	return $content;
}



try
{	
	var_dump(get_class_methods('Exception'));
	if($content=openFile())	
		foreach($content as $valor)
			echo $valor.'<br>';
}
catch(nullFileException $e)
{
	//echo '<br>'.$e->getMessage().'<br>';
	
	echo $e->getPrevious().'<br>';
}
catch(nonFileException $e){
	echo $e->getMessage().'<br>';
}
catch(readFileException $e){
	echo $e->getMessage().'<br>';
}
 ?>