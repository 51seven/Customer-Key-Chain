<h2>Neue Kombination anlegen</h2>

<?php echo $this->Form->create('Combination', array(
	'type' => 'post',
	'role' => 'form',
	'class' => 'form-horizontal'
)); 
?>
<?php echo $this->Form->hidden('customer_id'); ?>
<?php echo $this->Form->input('type_id', array(
	'label' => array(
		'text' => 'Typ'
	),
));
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
	'label' => 'Kombination anlegen',
	'class' => 'btn btn-success',
)); 
?>