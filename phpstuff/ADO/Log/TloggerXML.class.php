<?php 

final class TloggerXML extends Tlogger
{
	/* Método Write;
	*escreve uma mensagem de log no aruivo de log
	*/

	public function write($message)
	{
		$time= date("Y-m-d H:i:s");
		$text="<log>\n";
		$text.="	<time>$time</time>\n";
		$text.="	<message>$message</message>\n";
		$text.="</log>\n";

		$handler= fopen($this->filename,'a');
		fwrite($handler,$text);
		fclose($handler);
	}
}

 ?>