<div class="input-group">
<h1 class="primary">Kombination bearbeiten</h1>

<?php echo $this->Form->create('Combination', array(
	'type' => 'post',
	'class' => 'form-horizontal'
)); 
?>
<?php echo $this->Form->hidden('customer_id'); ?>
<?php echo $this->Form->hidden('type_id', array('label' => 'Zugangsdatentyp: ')); ?>
<?php
echo $this->Form->input('username', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Benutzername '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('password', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Passwort '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('loginurl', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Login URL '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('comment', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Zusätzliche Informationen '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
)); 
echo $this->Form->end(array(
	'label' => 'Speichern',
	'class' => 'btn btn-default',
	'div' => array('class' => 'form-group'),
	'before' => '<div class="col-sm-offset-2 col-sm-10">',
	'after' => '</div>',
)); 
?>
</div>