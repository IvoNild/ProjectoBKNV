<?php 

final class Ttransaction
{

	private static $conn;
	private static $logger;
	//para evitar que se tenha instâncias de Ttransaction
	private function __construct(){}

	//receber o objecto que vai tratar dos logs
	public static function setLogger(Tlogger $log)
	{
		self::$logger=$log;
	}
	public static function log($message)
	{
		if(self::$logger)
		{
			self::$logger->write($message);
		}
	}

	//recebe como argumento o nome de um banco de dados
	public static function open($dbname)
	{
		//para o caso de já estar aberta uma transação e ainda assim querer abrir outra
		//nesta caso a transação não abri
		if(empty(self::$conn)):
			self::$conn=Tconection::open($dbname);
			//inicia transação
			self::$conn->beginTransaction();
			//resetar logger(responsável pelo registro de log);
			self::$logger=NULL;
		endif;
	}

	//desfaz todas as alterações feitas ao banco de dados
	public static function rollback()
	{		
		if(self::$conn)
		{
			self::$conn->rollback();
			self::$conn=NULL;
		}
	}
	//retorna a conecçaõ ativa da transação
	public static function get()
	{
		return self::$conn;
	}
	//este método encerra a transação 
	public static function close()
	{
		if(self::$conn):
			//efectivar todas as alterações feitas ao banco nesta transação
			self::$conn->commit();
			self::$conn=NULL;
		endif;
	}
}





 ?>