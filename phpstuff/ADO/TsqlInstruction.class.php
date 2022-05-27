<?php 


abstract class TsqlInstruction 
{
	protected $sql;//armanzena a instrução sql
	protected $criteria;///armanzena uma classe Tcriteria
	protected $entity;
	//função para setar a entidade que está a referir a instrução
	final public function setEntity($entity)
	{
		$this->entity=$entity;
	}
	//função para obter a entidade que está a se referir a instrução
	final public function getEntity()
	{
		return $this->entity;
	}
	//método para setar o critério de seleção de dados
	public function setCriteria(Tcriteria $criteria)
	{
		$this->criteria=$criteria;
	}
	//função que tem que ser implementada pelas classe-filha
	//para obter a instrução final
	abstract protected function getInstruction();
	
}

 ?>