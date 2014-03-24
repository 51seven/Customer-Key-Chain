
<?php 
if(isset($contactpersons)) {
?>
	<h1>Kontaktpersonen von <?php echo $contacts[0]['Customer']['name']; ?></h1>
	<?php
	foreach ($contactpersons as $key => $contact) {
		echo "<section class='history'>";
			echo "<h3>";
				echo $contact['Contactperson']['title']." ";
				echo $contact['Contactperson']['prename']." ".$contact['Contactperson']['name'];
			echo "</h3>";

			echo "<strong>Tel: </strong>".$contact['Contactperson']['phone']."<br>";
			echo "<strong>Mobile: </strong>".$contact['Contactperson']['mobile']."<br>";
			echo "<strong>Mail: </strong>".$contact['Contactperson']['mail']."<br>";

			echo $this->Html->link('Bearbeiten', array(
				'controller' => 'contactperson',
				'action' => 'edit', $contact['Contactperson']['contactperson_id']
			));
			echo " ";
			echo $this->Html->link('Löschen', array(
				'controller' => 'contactperson',
				'action' => 'delete', $contact['Contactperson']['contactperson_id']
				),
				array(), "Willst du diesen Kunden wirklich entfernen?"
			);
		echo "</section>";
		echo "<hr>";
	}
}
else {
	echo "<h3>Keine Kontaktpersonen verfügbar.</h3>";
	echo "Jetzt ";
	echo $this->Html->link('neue Kontaktperson', array(
		'controller' => 'contactperson',
		'action' => 'create'
	));
	echo " erstellen.";
}

?>