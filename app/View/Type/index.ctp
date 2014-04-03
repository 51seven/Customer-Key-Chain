<h3>Alle Accounttypen:</h3>
<?php
foreach ($types as $key => $type) {
	echo $type." ";
	echo $this->Html->link('', 
		array('action' => 'edit', $key), 
		array('class' => array(
			'edit', 'glyphicon', 'glyphicon-pencil')
		)
	)." ";
	echo $this->Html->link('', 
		array('action' => 'delete', $key), 
		array('class' => array(
			'edit', 'glyphicon', 'glyphicon-trash')
		), "Diesen Typ wirklich entfernen?\nDazu darf kein Kunde diesen Typ benutzen."
	)."<br>";
}


?>