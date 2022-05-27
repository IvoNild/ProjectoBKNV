<?php 

final class TloggerTXT extends Tlogger
{
	/* Método Write;
	*escreve uma mensagem de log no aruivo de log
	*/
	public function write($message)
	{
		$time= date("Y-m-d H:i:s");
		$text="$time: $message\n";
		$handler= fopen($this->filename,'a');
		fwrite($handler,$text);
		fclose($handler);
	}
}

 ?>