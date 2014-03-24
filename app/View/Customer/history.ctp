<h1>History von <?php echo $history[0]['Customer']['name']; ?></h1>
<?php
foreach ($history as $key => $h) {
	echo "<section class='history'>";
		echo "<h3>";
			echo $this->Time->format($h['History']['time'], '%d.%m.%y');
			echo "<small>";
				echo $this->Time->format($h['History']['time'], ' %k:%M');
				echo " - ".$h['User']['username'];
			echo "</small>";
		echo "</h3>";

		echo "<p class='text'>".$h['History']['text']."</p>";

		echo "<span class='options'>";
			echo $this->Html->link('Bearbeiten', array(
				'controller' => 'history',
				'action' => 'edit', $h['History']['history_id']
			));
		echo " ";
		echo $this->Html->link('Löschen', array(
			'controller' => 'history',
			'action' => 'delete', $h['History']['history_id'],
			), array(), "Willst du diesen Eintrag wirklich entfernen?"
		);
	echo "</span>";
	echo "</section><hr>";
}