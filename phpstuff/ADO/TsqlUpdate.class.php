<?php 


/*Esta classe fornece recuros para a operações de UPDATE em banco de dados*/
final class TsqlUpdate extends TsqlInstruction
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
	public function getInstruction()
	{
		$this->sql='UPDATE '.$this->entity.' SET ';
		foreach($this->columnValue as $key=>$value)
			$this->sql.="$key = $value, ";
		$this->sql=' '.substr($this->sql,0,-2);

		if(isset($this->criteria))
			$this->sql.=' WHERE '.$this->criteria->dump();
		return $this->sql;
	}
}


 ?>