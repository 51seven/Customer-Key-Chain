<div class="input-group">
<h2 class="primary">Zugangstyp bearbeiten</h2>
<?php
echo $this->Form->create('Type', array(
	'type' => 'post',
	'class' => 'form-horizontal'
	)
);
echo $this->Form->hidden('type_id');
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
echo $this->Form->end(array(
	'label' => 'Speichern',
	'class' => 'btn btn-default',
	'div' => array('class' => 'form-group'),
	'before' => '<div class="col-sm-offset-2 col-sm-10">',
	'after' => '</div>',
)); 
?>
</div>