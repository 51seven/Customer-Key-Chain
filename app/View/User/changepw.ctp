<h2>Passwort ändern</h2>
<p><strong>Hinweis:</strong> Dein Passwort wird mit einem Salt gehasht.</p>
<div class="input-group">
<?php
echo $this->Form->create('User', array(
	'type' => 'post',
	'class' => 'form-horizontal'
	)
);
echo $this->Form->input('old_password', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Altes Passwort '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
	'type' => 'password'
));
echo $this->Form->input('password', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Neues Passwort '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
	'type' => 'password'
));
echo $this->Form->input('confirm_password', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Wiederholung '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
	'type' => 'password'	
));

echo $this->Form->end(array(
	'label' => 'Ändern',
	'class' => 'btn btn-default',
	'div' => array('class' => 'form-group'),
	'before' => '<div class="col-sm-offset-2 col-sm-10">',
	'after' => '</div>',
)); 
?>
</div>