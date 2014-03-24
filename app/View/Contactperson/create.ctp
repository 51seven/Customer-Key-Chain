<h1>Neue Kontaktperson anlegen</h1>
<?php
echo $this->Form->create('Contactperson', array(
	'type' => 'post'
));
$title = array('Herr' => 'Herr', 'Frau' => 'Frau');
echo $this->Form->input('title', array(
    'options' => $title, 
	'label' => 'Anrede: ', 
));
echo $this->Form->input('prename', array(
	'label' => 'Vorname: ', 
));
echo $this->Form->input('name', array(
	'label' => 'Nachname: ', 
));
echo $this->Form->input('phone', array(
	'label' => 'Telefonnummer: ', 
));
echo $this->Form->input('mobile', array(
	'label' => 'Mobilfunknummer: ', 
));
echo $this->Form->input('mail', array(
	'label' => 'Email: ', 
));
echo $this->Form->end('Kontaktperson anlegen'); 
?>