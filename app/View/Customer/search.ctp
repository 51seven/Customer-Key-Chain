<h1>Kunden mit <i>'<?php echo $string; ?>'</i></h1>
<?php
foreach ($results as $key => $result) {
	echo $this->Html->link($result, array(
		'controller' => 'customer', 
		'action' => 'view/'.$key
		)
	)."<br>";
}
?>


