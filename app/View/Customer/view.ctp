<h1 class="with-options"><?php echo $customer['Customer']['name']; ?></h1>
	<span class="optionbar">
		<?php echo $this->Html->link('', array(
			'controller' => 'customer', 
			'action' => 'delete', $customer['Customer']['customer_id']
			),
		    array('class' => 'custom edit'), 
		    'Möchstest du den Kunden wirklich löschen?'
		); ?>

		<?php echo $this->Html->link('', array(
			'type' => 'button', 
			'class' => 'custom edit', 
			'alt' => 'Bearbeiten'
		)); ?>
		<span class="spacer"> </span>
		<?php echo $this->Form->button('', array(
			'type' => 'button', 
			'class' => 'custom delete', 
			'alt' => 'Löschen'
		)); ?>
	</span>
<?php
foreach ($combinations as $key => $combination) {
	echo '<h3>'.$combination['Type']['name'].'</h3>';
	?>
	<table class="default-table align-left">
	<?php
	echo '<tr><td><b>Benutzername:</b></td><td>'.$combination['Combination']['username']."</td></tr>";
	echo '<tr><td><b>Passwort:</b></td><td>'.$combination['Combination']['password']."</td></tr>";
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
?>



