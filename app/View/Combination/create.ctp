<div class="input-group">
<h1 class="primary">Neue Kombination anlegen</h1>

<?php echo $this->Form->create('Combination', array(
	'type' => 'post',
	'role' => 'form',
	'class' => 'form-horizontal'
)); 
?>
<?php echo $this->Form->hidden('customer_id'); ?>
<?php echo $this->Form->input('type_id', array(
	'label' => array(
		'text' => 'Zugangsdatentyp '
	),
));
echo $this->Form->input('username', array(
	'label' => array(
		'text' => 'Benutzername '
	),
));
echo $this->Form->input('password', array(
	'label' => array(
		'text' => 'Passwort '
	),
));
echo $this->Form->input('loginurl', array(
	'label' => array(
		'text' => 'Login URL '
	),
));
echo $this->Form->input('comment', array(
	'label' => array(
		'text' => 'Zusätzliche Informationen '
	),
)); 
echo $this->Form->end(array(
	'label' => 'Kombination anlegen',
	'class' => 'btn btn-default',
)); 
?>
</div>
