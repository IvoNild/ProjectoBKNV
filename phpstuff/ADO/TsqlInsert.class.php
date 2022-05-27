<?php 

final class TsqlInsert extends TsqlInstruction
{
	public function setRowData($column,$value)
	{
		if(is_string($value))
		{
			//adiciona \ em aspas
			$value=addslashes($value);
			//caso seja uma string
			$this->columnValue[$column]="'$value'";
		}
		elseif(is_bool($value))
			$this->columnValue[$column]=$value?'TRUE':'FALSE';
		//gerar um erro caso seja um array o valor passado
		elseif(is_array($value))
			throw new Exception('Value set to the row cann not be an array');
		elseif(isset($value))
			$this->columnValue[$column]=$value;//caso seja de um outro tipo de dados
		else
			$this->columnValue[$column]='NULL';

	}
	public function setCriteria($criteria)
	{
		throw new Exception('Cann not call setCriteria from'.__CLASS__);
	}
	public function getInstruction()
	{
		$this->sql='INSERT INTO '.$this->entity.'(';
		$this->sql.=implode(',',array_keys($this->columnValue)).') VALUES (';
		$this->sql.=implode(',',array_values($this->columnValue)).')';
		return $this->sql;
	}
}

 ?>