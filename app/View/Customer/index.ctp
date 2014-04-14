<h2>Hi <small><?= $user['username'] ?></small></h2>

<?php $role = array(0 => 'Gast', 1 => 'Admin');?>

Rolle: <?= $role[$user['isadmin']] ?><br><br>
Kombinationen: <?= $combination_count ?><br>
Kunden: <?= $customer_count ?><br><br>
Kein Kundenkontakt seit über 30 Tagen mit: <br>
<?php
	foreach ($frozen_customers as $customer => $value) {
		echo " - ";
		echo $this->Html->link($value['Customer']['name'], array(
			'controller' => 'customer',
			'action' => 'view', $value['History']['customer_id'],
		));

		$then = new DateTime($value[0]['time']);
        $now = new DateTime(date("Y-m-d"));

        echo $then->diff($now)->format(" (~%a Tage)")."<br>";
        // Add Tooltip with Date here?
		//echo " ".$this->Time->format($value[0]['time'], ' (%d.%m.%y)')."<br>";
	}
?>
<br><br>

<?php
	foreach ($news as $key => $value) {
		//$value['History']['time'];
		$date = "12.03.2014";
		$time = "12:24 Uhr";

		echo "<div class='newsticker'>";
		echo "<h3>".$this->Time->format($value['History']['time'], "%d.%m.%y um %k:%M Uhr")."</h3>";
		echo "<ul>";
			echo "<li>".$this->Html->link($value['Customer']['name'], array(
				'controller' => 'customer', 'action' => 'view', $value['Customer']['customer_id']))."</li>";
			echo "<li>".$value['User']['username']."</li>";
		echo "</ul>";
		echo "<p>".$value['History']['text']."</p>";
		echo "</div>";
		echo "<hr>";
	}
	
?>




