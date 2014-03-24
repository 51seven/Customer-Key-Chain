<div class="input-group">
<h1 class="primary">Neue Eintrag anlegen</h1>
<?php
echo $this->Form->create('History', array(
	'type' => 'post',
	'class' => 'form-horizontal'
));
echo $this->Form->input('text', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Text '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->input('time', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Datum '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>', 
));
echo $this->Form->end(array(
	'label' => 'Eintrag anlegen',
	'class' => 'btn btn-default',
	'div' => array('class' => 'form-group'),
	'before' => '<div class="col-sm-offset-2 col-sm-10">',
	'after' => '</div>',
)); 
?>
</div>