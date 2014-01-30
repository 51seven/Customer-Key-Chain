<h1>Kunden mit <i>'<?php echo $string; ?>'</i></h1>
<?php
foreach ($results as $key => $result) {
	echo $this->Html->link($result['Customer']['name'], array(
		'controller' => 'customer', 
		'action' => 'view/'.$result['Customer']['customer_id']
		)
	)."<br>";
}
?>


