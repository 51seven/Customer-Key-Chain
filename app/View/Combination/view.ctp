<h1><?php echo $combination['Type']['name']." von ".$combination['Customer']['name']; ?></h1>
<?php
echo '<b>Benutzername:</b> '.$combination['Combination']['username']."<br>";
echo '<b>Passwort:</b>     '.$combination['Combination']['password']."<br>";
echo '<b>Kommentar:</b>    '.$combination['Combination']['comment']."<br>";

echo "<br>";

echo $this->Html->link('Bearbeiten', array(
	'controller' => 'combination',
	'action' => 'edit/'.$combination['Combination']['combination_id']
));
echo " ";
echo $this->Html->link('Löschen', array(
	'controller' => 'combination',
	'action' => 'delete/'.$combination['Combination']['combination_id']
));
?>
