<h1>Übersicht aller Kunden</h1>
<?php
foreach ($customers as $key => $customer) {
	echo $this->Html->link($customer['Customer']['name'], array(
		'controller' => 'customer', 
		'action' => 'view/'.$customer['Customer']['customer_id']
		)
	)."<br>";
}

?>


