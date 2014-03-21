<div class="input-group">
<h1 class="primary">Neuen Kunden anlegen</h1>
<?php
echo $this->Form->create('Customer', array(
	'type' => 'post',
	'class' => 'form-horizontal',
));
echo $this->Form->input('name', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Name '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));

echo $this->Form->input('tel', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Telefon '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('street', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Straße '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('zip', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'PLZ '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('city', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Stadt '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->end(array(
	'label' => 'Kunde anlegen',
	'class' => 'btn btn-default',
	'div' => array('class' => 'form-group'),
	'before' => '<div class="col-sm-offset-2 col-sm-10">',
	'after' => '</div>',
)); 
?>
</div>