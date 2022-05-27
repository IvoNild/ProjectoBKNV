<?php 


final class TloggerHTML extends Tlogger
{
	/* Método Write;
	*escreve uma mensagem de log no aruivo de log
	*/

	public function write($message)
	{
		$time= date("Y-m-d H:i:s");
		$text="<p>";
		$text.="	<b>$time:</b>";
		$text.="	<i>$message</i>";
		$text.="</p><br>";
		$handler= fopen($this->filename,'a');
		fwrite($handler,$text);
		fclose($handler);
	}
}


 ?>