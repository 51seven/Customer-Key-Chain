<div class="jumbotron clearfix">
<div class="row">
	<h1>Hi, <?= $user['username'] ?></h1>
	<div class="col-xs-6" style="padding-left: 0;">
	<p>
	<?php $role = array(0 => 'Gast', 1 => 'Admin');?>
	Du bist als <strong><?= $role[$user['isadmin']] ?></strong> eingeloggt.<br><br>
	Kombinationen <span class="badge"><?= $combination_count ?></span><br>
	Kunden <span class="badge"><?= $customer_count ?></span><br>
	History <span class="badge"><?= $history_count ?></span><br><br>

	Tags used <span class="badge"><?= $tags_used_count ?></span>, unused <span class="badge"><?= $tags_unused_count ?></span><br>
	Beliebtestes Tag <span class="badge"><?= $most_popular_tag ?></span><br>
	</p>
	</div>
	<div class="col-xs-6">
	<p>
	<small class="glyphicon glyphicon-time"></small> Kontaktlos seit über 30 Tagen: <br><br>
	<?php
		foreach ($frozen_customers as $customer => $value) {
			$then = new DateTime($value[0]['time']);
	        $now = new DateTime(date("Y-m-d"));

			if($then->diff($now)->format('%a') > 90) { // Critical amount of days
				echo "<small class='glyphicon glyphicon-fire'></small> ";
			}
			else {
				echo "<small class='glyphicon glyphicon-eye-open'></small> ";
			}

			echo $this->Html->link($value['Customer']['name'], array(
				'controller' => 'customer',
				'action' => 'view', $value['History']['customer_id'],
			));

	        echo $then->diff($now)->format(" <small 
	        	data-toggle='tooltip' 
	        	data-placement='right' 
	        	title='".$then->format('d.m.Y')."'>(~%a Tage)</small>")."<br>";
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

	echo "<p class='text-center'>".$this->Html->link('Alle anzeigen', array('controller' => 'history', 'action' => 'newsfeed'))."</p>";
?>




