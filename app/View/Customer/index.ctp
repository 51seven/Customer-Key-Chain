<h2>Hi <small><?php echo $user['username']; ?></small></h2>

Admin: <?php echo $user['isadmin']."<br>"; ?>

<?php 
echo "Gespeicherten Kombinationen: ".$combination_count."<br>";
echo "Anzahl an Kunden: ".$customer_count."<br><br>";
echo "Anzahl an Kunden: ".$customer_count."<br>";

echo "Kein Kundenkontakt seit 30 Tagen: <br>";
	foreach ($frozen_customers as $customer => $value) {
		echo $customer;
	}
?>




