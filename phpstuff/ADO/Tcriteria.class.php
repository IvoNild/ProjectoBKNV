<?php 
//Esta classe define um critério de seleção de dados
class Tcriteria extends Texpression
{
	private $property;//armazena uma propriedade
	private $expression;//armazena expressões
	private $operator;//Armanzena operadores

	public function add(Texpression $expression,$operator=self::AND_OPERATOR)
	{	
		//na primeira vez, não precisa de operadores
		if(empty($this->operator))
			$this->operator[]=NULL; //aqui atribui-se nulo a primeira posição da lista dos operadores, pois não precisamos.
		else
			$this->operator[]=$operator;
		$this->expression[]=$expression;
	}
	//estas funções são para setagem de propriedades
	//tais como:
	//limit, order by, group by...
	public function setProperty($property,$value)
	{
		//converte as chaves de index para minúscula, afim de evitar
		//erro de lógica caso alguem, por exemplo escreva "LIMIT" em detrimento de "limit"
		$this->property[strtolower($property)]=$value;
	}
	public function getProperty($property)
	{
		if(isset($this->property[$property]))
			return $this->property[$property];
	}
	public function dump()
	{
		if(!empty($this->expression))
		{
			$result=null;
			foreach($this->expression as $key=>$valor)
				$result.="{$this->operator[$key]} {$valor->dump()} ";
			trim($result);
			return "($result)";
		}
	}
}

 ?>