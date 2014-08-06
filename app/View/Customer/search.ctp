<h3>Kunden namens <i>'<?= $string ?>'</i></h3>
<?php
if($customer_results) {
	foreach ($customer_results as $customer => $result) {
		echo $this->Html->link($result, array(
			'controller' => 'customer', 
			'action' => 'view', $customer
			)
		)."<br>";
	}
}
else {
	echo "Keine Kunden gefunden.";
}
?>
<h3>Kontakte namens <i>'<?= $string ?>'</i></h3>
<?php
if($contact_results) {
	foreach ($contact_results as $contact => $result) {
		echo $this->Html->link($result['Contactperson']['fullname'], array(
			'controller' => 'contactperson', 
			'action' => 'listall', $result['Customer']['customer_id']
			)
		)."<br>";
	}
}
else {
	echo "Keine Kontakte gefunden.";
}
?>
<h3>Kombinationen die mit <i>'<?= $string ?>'</i> getagged wurden</h3>
<?php
if($tags_results) {
	foreach ($tags_results as $key => $tag) {
		echo $tag['Customer']['name']." mit ";
		echo $this->Html->link($tag['username'], array(
			'controller' => 'combination', 
			'action' => 'view', $tag['combination_id']
			)
		)."<br>";
	}
}
else {
	echo "Keine Tags gefunden.";
}
?>