<h1>Suche nach Kunden mit <?php echo $string; ?></h1>

<?php
echo $this->Html->link('Zurück', array(
	'controller' => 'customer',
	'action' => 'index'
));
echo "<br>";
echo "<br>";

foreach ($results as $key => $result) {
	echo $this->Html->link($result['Customer']['name'], array(
		'controller' => 'customer', 
		'action' => 'view/'.$result['Customer']['customer_id']
		)
	)."<br>";
}

?>


