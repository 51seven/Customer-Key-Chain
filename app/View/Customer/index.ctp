<h2>Hi <small><?php echo $user['username']; ?></small></h2>

<?php 
$role = array(0 => 'Gast', 1 => 'Admin');
echo "Rolle: ".$role[$user['isadmin']]."<br><br>";

echo "Kombinationen: ".$combination_count."<br>";
echo "Kunden: ".$customer_count."<br><br>";

echo "Kein Kundenkontakt seit über 30 Tagen mit: <br>";
	foreach ($frozen_customers as $customer => $value) {
		echo " - ".$value['Customer']['name'].$this->Time->format($value[0]['time'], ' (%d.%m.%y)')."<br>";
	}
?>




