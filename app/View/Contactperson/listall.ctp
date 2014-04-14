
<?php 
if(isset($contactpersons)) {
?>
	<h1>Kontaktpersonen von <?php echo $contactpersons[0]['Customer']['name']; ?></h1>
	<?php
	foreach ($contactpersons as $key => $contact) {
		echo "<section class='history'>";
			echo "<h3>";
				echo $contact['Contactperson']['title']." ";
				echo $contact['Contactperson']['prename']." ".$contact['Contactperson']['name'];
			echo "</h3>";

			echo "<ul class='no-list-style'>";
				echo "<li><span class='glyphicon glyphicon-phone-alt' /> ".$contact['Contactperson']['phone']."</li>";
				echo "<li><span class='glyphicon glyphicon-earphone' /> ".$contact['Contactperson']['mobile']."</li>";
				echo "<li><span class='glyphicon glyphicon-envelope' /> ".$contact['Contactperson']['mail']."</li>";
			echo "</ul>";

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