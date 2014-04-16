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
		'text' => 'Altes Passwort '
	),
	'type' => 'password'
));
echo $this->Form->input('password', array(
	'label' => array(
		'text' => 'Neues Passwort '
	),
	'type' => 'password'
));
echo $this->Form->input('confirm_password', array(
	'label' => array(
		'text' => 'Wiederholung '
	),
	'type' => 'password'	
));

echo $this->Form->end(array(
	'label' => 'Ändern',
	'class' => 'btn btn-default',
)); 
?>
</div>