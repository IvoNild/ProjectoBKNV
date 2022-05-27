<?php 


class TsqlSelect extends TsqlInstruction
{
	private $columns;
	//este método permite adicionar quais colunas dever ser exibidas  após a consulta
	public function addColumn($columns)
	{
		$this->columns[]=$columns;
	}

	public function getInstruction()
	{
		//caso nenhuma coluna tenha sido selecionada para a exibição
		if(empty($this->columns))
			$this->sql='SELECT * FROM '.$this->entity.' ';
		else
			$this->sql='SELECT '.implode(',',$this->columns).' FROM '.$this->entity.' ';
		//procura se há algum critério de seleção
		if(isset($this->criteria))
		{	
			//verifica se há um critério de seleção
			if($this->criteria->dump())
				$this->sql.= ' WHERE '.$this->criteria->dump().' ';
			
			$order=$this->criteria->getProperty('order');
			$limit=$this->criteria->getProperty('limit');
			$offset=$this->criteria->getProperty('offset');

			//verifica se uma propriedade de seleção foi enunciada
			if($order)
				$this->sql.=' ORDER BY '.$order.' ';
			if($limit)
				$this->sql.=' LIMIT '.$limit.' ';
			if($offset)
				$this->sql.=' OFFSET '.$offset.' ';
		}
		return $this->sql;
	}
}



 ?>