<?php 
include_once 'produto.class.php';

$conn= new PDO('mysql:host=localhost;port=3307;dbanme=diassonama','root','');



/*if($conn= new PDO('mysql:host=localhost;port=3306;dbname=diassonama','root','')):
	if($datas=$conn->query('select *from cliente')):
		echo 'Número de linhas retornadas :'.$datas->rowCount().'<br>';
		echo 'Número de colunas retornadas :'.$datas->columnCount().'<br>';
		while($linha=$datas->fetch(PDO::FETCH_ASSOC)):
			print_r($linha);
			echo '<br>';
		endwhile;
	else:
		echo 'Nenhum registro achado<br>';
endif;


	echo 'Propriedades de objectos e variaveis<br>';
	$result=get_class_methods('PDO');
	var_dump(get_class_vars('PDO'));
	echo '<br>';
	var_dump($conn->getAvailableDrivers());
	echo '<br>';
	foreach($result as $methodNumber=>$name)
		echo ++$methodNumber."==== $name<br>";
	foreach(get_class_methods('pdoStatement') as $methodNumber=>$name)
		echo ++$methodNumber."==== $name<br>";
	

endif;
*/
 ?>