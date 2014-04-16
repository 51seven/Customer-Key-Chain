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
		'text' => 'Name '
	),
));
echo $this->Form->end(array(
	'label' => 'Speichern',
	'class' => 'btn btn-default',
)); 
?>
</div>