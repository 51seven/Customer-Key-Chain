<div class="input-group">
<h1 class="primary">Neuen Funfact anlegen</h1>
<?php
echo $this->Form->create('Funfact', array(
	'type' => 'post',
	'class' => 'form-horizontal',
));
echo $this->Form->hidden('customer_id');

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
echo $this->Form->end(array(
	'label' => 'Funfact anlegen',
	'class' => 'btn btn-default',
	'div' => array('class' => 'form-group'),
	'before' => '<div class="col-sm-offset-2 col-sm-10">',
	'after' => '</div>',
)); 
?>
</div>