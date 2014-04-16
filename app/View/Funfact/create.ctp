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
		'text' => 'Text '
	),
));
echo $this->Form->end(array(
	'label' => 'Funfact anlegen',
	'class' => 'btn btn-default',
)); 
?>
</div>