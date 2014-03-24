<div class="input-group">
<h1 class="primary">Neue Kontaktperson anlegen</h1>
<?php
echo $this->Form->create('Contactperson', array(
	'type' => 'post',
	'class' => 'form-horizontal',
));
$title = array('Herr' => 'Herr', 'Frau' => 'Frau');
echo $this->Form->input('title', array(
    'options' => $title, 
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Anrede '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('prename', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Vorname '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('name', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Nachname '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('phone', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Telefon '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('mobile', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Mobil '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('mail', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Email '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->end(array(
	'label' => 'Kontaktperson anlegen',
	'class' => 'btn btn-default',
	'div' => array('class' => 'form-group'),
	'before' => '<div class="col-sm-offset-2 col-sm-10">',
	'after' => '</div>',
)); 
?>
</div>