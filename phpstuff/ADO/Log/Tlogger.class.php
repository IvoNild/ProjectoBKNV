<?php 

abstract class Tlogger
{
	protected $filename;

	public function __construct($filename)
	{
		$this->filename=$filename;
		//reseta o arquivo que armazenará o log
		//caso não esteja vázio, esvazia
		if(empty(file($filename)))
			file_put_contents($filename,'');	
	}
	//define-se um método obrigatório
	abstract public function write($message);
}





 ?>