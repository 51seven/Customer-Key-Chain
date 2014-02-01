<h1 class="with-options"><?php echo $customer['Customer']['name']; ?></h1>
	<span class="optionbar">
		<?php echo $this->Html->link('Neue Kombination', array(
			'controller' => 'combination', 
			'action' => 'create', $customer['Customer']['customer_id'],
		)); ?>
		<br>
		<?php echo $this->Html->link('Toggle Favorit', array(
			'controller' => 'user', 
			'action' => 'favorite', $customer['Customer']['customer_id'],
		)); ?>
		<br>
		<?php echo $this->Html->link('edit', array(
			'controller' => 'customer', 
			'action' => 'edit', $customer['Customer']['customer_id'],
		)); ?>
		<br>
		<?php echo $this->Html->link('delete', array(
			'controller' => 'customer', 
			'action' => 'delete', $customer['Customer']['customer_id'],
		)); ?>
	</span>
<?php
if(sizeof($combinations) > 0) {
	foreach ($combinations as $key => $combination) {
		echo '<h3>'.$combination['Type']['name'].'</h3>';
		?>
		<table class="default-table align-left">
		<?php
		echo '<tr><td><b>Benutzername:</b></td><td>'.$combination['Combination']['username']."</td></tr>";
		echo '<tr><td><b>Passwort:</b></td><td>'.$combination['Combination']['password']."</td></tr>";
		if($combination['Combination']['loginurl'] != null) {
			echo '<tr><td><b>Login URL:</b></td><td>'.$this->Html->link(
				$combination['Combination']['loginurl'], 
				'http://'.$combination['Combination']['loginurl'],
				array('target' => '_blank')
			)."</td></tr>";
		}
		echo '<tr><td><b>Kommentar:</b></td><td>'.$combination['Combination']['comment']."</td></tr>";

		echo '<tr><td>'.$this->Html->link('Bearbeiten', array(
			'controller' => 'combination',
			'action' => 'edit/'.$combination['Combination']['combination_id']
		)).'</td>';
		echo '<td>'.$this->Html->link('Löschen', array(
			'controller' => 'combination',
			'action' => 'delete/'.$combination['Combination']['combination_id']
		)).'</td><td></tr>';
		?>
		</table>
		<hr>
	<?php
	}
}
else {
	echo "<br><br>Für diesen Kunden sind noch keine Kombinationen gespeichert.";
}
?>



