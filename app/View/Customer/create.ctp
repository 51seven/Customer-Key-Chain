<h1>Neuen Kunden anlegen</h1>
<?php
echo $this->Form->create('Customer', array(
	'type' => 'post'
));
echo $this->Form->input('name', array(
	'label' => 'Name des Kunden: ', 
));
echo $this->Form->input('tel', array(
	'label' => 'Telefonnummer: ', 
));
echo $this->Form->input('street', array(
	'label' => 'Straße', 
));
echo $this->Form->input('zip', array(
	'label' => 'PLZ: ', 
));
echo $this->Form->input('city', array(
	'label' => 'Stadt ', 
));
echo $this->Form->end('Kunde anlegen'); 
?>