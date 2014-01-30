<h1><?php echo $combination['Type']['name']." von ".$combination['Customer']['name']; ?></h1>
<table class="default-table">
<?php
echo '<tr><td><b>Benutzername:</b></td><td>'.$combination['Combination']['username']."</td></tr>";
echo '<tr><td><b>Passwort:</b></td><td>'.$combination['Combination']['password']."</td></tr>";
echo '<tr><td><b>Kommentar:</b></td><td>'.$combination['Combination']['comment']."</td></tr>";

echo '<tr><td>'.$this->Html->link('Bearbeiten', array(
	'controller' => 'combination',
	'action' => 'edit/'.$combination['Combination']['combination_id']
)).'</td><td>';
echo '<td>'.$this->Html->link('Löschen', array(
	'controller' => 'combination',
	'action' => 'delete/'.$combination['Combination']['combination_id']
)).'</td><td></tr>';
?>
</table>
