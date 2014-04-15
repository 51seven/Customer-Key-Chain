<div class="jumbotron clearfix">
<div class="row">
	<h1>Hi, <?= $user['username'] ?></h1>
	<div class="col-xs-6" style="padding-left: 0;">
	<p>
	<?php $role = array(0 => 'Gast', 1 => 'Admin');?>
	Du bist als <?= $role[$user['isadmin']] ?> eingeloggt.<br><br>
	Kombinationen <span class="badge"><?= $combination_count ?></span><br>
	Kunden <span class="badge"><?= $customer_count ?></span><br>
	History <span class="badge"><?= $history_count ?></span><br>
	</p>
	</div>
	<div class="col-xs-6">
	<p>
	Kontaktlos seit über 30 Tagen: <br><br>
	<?php
		foreach ($frozen_customers as $customer => $value) {
			//echo " - ";
			echo $this->Html->link($value['Customer']['name'], array(
				'controller' => 'customer',
				'action' => 'view', $value['History']['customer_id'],
			));

			$then = new DateTime($value[0]['time']);
	        $now = new DateTime(date("Y-m-d"));

	        echo $then->diff($now)->format(" <small>(~%a Tage)</small>")."<br>";
	        // Add Tooltip with Date here?
			//echo " ".$this->Time->format($value[0]['time'], ' (%d.%m.%y)')."<br>";
		}
	?>
	<br>
	</p>
	</div>
</div>
</div>

<br><br>

<?php
	foreach ($news as $key => $value) {
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

	echo $this->Html->link('Alle anzeigen', array('controller' => 'history', 'action' => 'newsfeed'));
?>




