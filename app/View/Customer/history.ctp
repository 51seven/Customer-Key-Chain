<h1>History von <?php echo $history[0]['Customer']['name']; ?></h1>
<?php
foreach ($history as $key => $h) {
	echo "<h3>".$h['History']['time']."</h3>";
	echo $h['History']['text']."<br>";

	echo $this->Html->link('Bearbeiten', array(
		'controller' => 'history',
		'action' => 'edit', $h['History']['history_id']
	));
	echo " ";
	echo $this->Html->link('Löschen', array(
		'controller' => 'history',
		'action' => 'delete', $h['History']['history_id']
		),
		array(), "Willst du diesen Eintrag wirklich entfernen?"
	);

	echo "<hr>";
}