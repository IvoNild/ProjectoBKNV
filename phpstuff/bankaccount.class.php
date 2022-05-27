<?php 


class Pessoa
{
	var $codigo;
	var $nome;
	var $sobrenome;
	var $altura;
	var $idade;
	//função  construtora que inicia todos os valores
	function __construct($codigo,$nome,$sobrenome,$altura,$idade)
	{
		$this->codigo=$codigo;
		$this->nome=$nome;
		$this->sobrenome=$sobrenome;
		$this->altura=$altura;
		$this->idade=$idade;
	}

	// este metodo incrementa a altura em centimetros
	function Crescer($altura)
	{
		$this->altura+=$altura;
	}
	//esta função incrementa a idade em anos
	function Envelhecer($idade)
	{
		$this->idade+=$idade;
	}

	//função  de término
	function __destruct()
	{
		echo "Terminando o  objecto {$this->nome} {$this->sobrenome}....<br>";
	}
}


class Conta
{
	var $agencia;
	var $codigo;
	var $dataCriacao;
	var $titular;
	var $senha;
	var $saldo;
	var $cancelada;

	//construtor
	function __construct($agencia,$codigo,$dataCriacao,$titular,$senha,$saldo,$cancelada)
	{
		$this->agencia=$agencia;
		$this->codigo=$codigo;
		$this->dataCriacao=$dataCriacao;
		$this->titular=$titular;
		$this->senha=$senha;
		$this->saldo=$saldo;
		$this->cancelada=$cancelada;
	}

	//este metodo decrementa o saldo
	function Retirar($quantia)
	{
		if($quantia>0)
			$this->saldo-=$quantia;
	}
	//Este metodo Exibe o saldo
	function Depositar($quantia)
	{
		if($quantia>0)
			$this->saldo+=$quantia;
	}
	//Este metodo exibe o saldo da conta
	function ExibirSaldo()
	{
		echo 'Crédito atual :'.$this->saldo;
	}

	//função  de término
	function __destruct()
	{
		echo "Terminando o  objecto de conta {$this->titular->nome} {$this->titular->sobrenome}....<br>";
	}
}

//esta classe diz respeito a um tipo diferente de conta
class ContaPoupanca extends Conta
{
	var $aniversario;

	//ca é reescrito o  método construtor
	function __construct($agencia,$codigo,$dataCriacao,$titular,$senha,$saldo,$cancelada,$aniversario)
	{
		parent::__construct($agencia,$codigo,$dataCriacao,$titular,$senha,$saldo,$cancelada);
		$this->aniversario=$aniversario;

	}


	//reescreve-se o método retirar
	function Retirar($quantia)
	{
		if($this->saldo>=$quantia)
			parent::Retirar($quantia);
		else
		{
			echo "Retirada de {$quantia} não permitida<br>";
			return false;
		}
		return true;
	}
}
//esta classe diz respeito a um outro gênero de conta
class ContaCorrente extends Conta implements  exemple
{
	var $limite;

	//ca é reescrito o  método construtor
	function __construct($agencia,$codigo,$dataCriacao,$titular,$senha,$saldo,$cancelada,$limite)
	{
		parent::__construct($agencia,$codigo,$dataCriacao,$titular,$senha,$saldo,$cancelada);
		$this->limite=$limite;
	}


	//reescreve-se o método retirar
	function Retirar($quantia)
	{
		$imposto;

		if(($this->saldo + $this->limite)>=$quantia)
		{
			//executa um método da classe pai
			$imposto=0.05;
			parent::Retirar($quantia);
			//retirar o imposto
			parent::Retirar($quantia*$imposto);
		}
		else
		{
			echo "Retirada de {$quantia} não permitida...<br>";
			return false;
		}
	}
	function getNome(){}
	function setNome($nome){}
	function setResponsavel(Pessoa $pessoa){}
}


interface exemple
{
	function getNome();
	function setNome($nome);
	function setResponsavel(Pessoa $responsavel);
}


 ?>