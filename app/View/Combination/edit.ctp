<h1>Kombination bearbeiten</h1>

<?php
echo $this->Form->create('Combination', array(
	'type' => 'post'
));
echo $this->Form->hidden('customer_id', array(
	'label' => 'Kunde: ', 
));
echo $this->Form->hidden('type_id', array(
	'label' => 'Zugangsdatentyp: ', 
));
echo $this->Form->input('username', array(
	'label' => 'Benutzername/Email: ', 
));
echo $this->Form->input('password', array(
	'label' => 'Password: ', 
	'type' => 'password',
));
echo $this->Form->input('comment', array(
	'label' => 'Zusätzliche Informationen; ',
));
echo $this->Form->end('Kombination speichern'); 
?>


