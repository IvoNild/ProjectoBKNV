<?php 

class Tfilter extends Texpression
{
	private $variable;
	private $operator;
	private $value;

	/*metódo instancia um novo filtro*/
	function __construct($variable,$operator,$value)
	{
		$this->variable=$variable;
		$this->operator=$operator;
		//transforma o valor passsado para um formato adquado ao sql
		$this->value=$this->transform($value);
	}
	//este método transforma o argumento passado em um argumento adequado 
	//ao formato sql
	private function transform($value)
	{
		if(is_array($value))
		{
			foreach($value as $tmpValue)
			{
				if(is_integer($tmpValue))
					$foo[]=$tmpValue;
				if(is_string($tmpValue))
					$foo[]="'{$tmpValue}'";
			}
			//converte o array em uma string separada por ","
			$result='('.implode(',',$foo).')';
		}
		elseif(is_string($value))
			$result="'{$value}'";
		elseif(is_bool($value))
			$result=$value?'TRUE':'FALSE';
		elseif (is_null($value)) 
			$result='NULL';
		else
			$result=$value;
		//ca retorna-se o valor
		return $result;
	}
	//retorna o filtro em forma de expressão
	public function dump()
	{	
		//concatena a expressão
		return "{$this->variable}  {$this->operator}  {$this->value}";
	}
}



 ?>