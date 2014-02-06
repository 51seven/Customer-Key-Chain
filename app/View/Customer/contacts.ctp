<h1>Kontaktpersonen von <?php echo $contacts[0]['Customer']['name']; ?></h1>
<?php
foreach ($contacts as $key => $contact) {
	echo $contact['Contactperson']['title']." ".$contact['Contactperson']['prename']." ".$contact['Contactperson']['name']."<br>";	
	echo "Tel: ".$contact['Contactperson']['phone']."<br>";
	echo "Mobile: ".$contact['Contactperson']['mobile']."<br>";
	echo "Mail: ".$contact['Contactperson']['mail']."<br>";

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

	echo "<hr>";
}