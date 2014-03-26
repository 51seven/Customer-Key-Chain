<h3>Kunden mit <i>'<?php echo $string; ?>'</i></h3>
<?php
if($customer_results) {
	foreach ($customer_results as $customer => $result) {
		echo $this->Html->link($result, array(
			'controller' => 'customer', 
			'action' => 'view', $result
			)
		)."<br>";
	}
}
else {
	echo "Keine Kunden gefunden.";
}
?>
<h3>Kontakte mit <i>'<?php echo $string; ?>'</i></h3>
<?php
if($contact_results) {
	foreach ($contact_results as $contact => $result) {
		echo $this->Html->link($result['Contactperson']['fullname'], array(
			'controller' => 'contactperson', 
			'action' => 'view', $result['Contactperson']['contactperson_id']
			)
		)."<br>";
	}
}
else {
	echo "Keine Kontakte gefunden.";
}
?>


