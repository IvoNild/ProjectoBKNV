<?php 

final class TsqlDelete extends TsqlInstruction
{
	public function getInstruction()
	{
		$this->sql="DELETE FROM $this->entity ";
		
		//verifica se foi mostrado um crítério de seleção
		if(isset($this->criteria))
				$this->sql.=' WHERE '.$this->criteria->dump();
		return $this->sql;
	}
}

 ?>