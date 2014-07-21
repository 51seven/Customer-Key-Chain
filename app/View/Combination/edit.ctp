<h2>Kombination bearbeiten</h2>
<?php 
echo $this->Form->create('Combination', array(
	'type' => 'post',
	'role' => 'form',
	'class' => 'form-horizontal'
)); 
echo $this->Form->hidden('customer_id'); 
echo $this->Form->hidden('type_id', array('label' => 'Zugangsdatentyp: '));

echo $this->Form->input('username', array(
	'label' => array(
		'text' => 'Benutzername'
	),
));
echo $this->Form->input('password', array(
	'label' => array(
		'text' => 'Passwort'
	),
));
echo $this->Form->input('loginurl', array(
	'label' => array(
		'text' => 'Login'
	),
));
echo $this->Form->input('comment', array(
	'label' => array(
		'text' => 'Kommentar'
	),
)); 
echo $this->Form->end(array(
	'label' => 'Speichern',
	'class' => 'btn btn-success',
)); 
?>