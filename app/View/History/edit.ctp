<div class="input-group">
<h1 class="primary">Eintrag bearbeiten</h1>
<?php
echo $this->Form->create('History', array(
	'type' => 'post',
	'class' => 'form-horizontal'
));

echo $this->Form->hidden('history_id');
echo $this->Form->hidden('customer_id');

echo $this->Form->input('text', array(
	'label' => array(
		'text' => 'Text '
	),
));
echo $this->Form->input('time', array(
	'label' => array(
		'text' => 'Datum '
	),
	'id' => 'datepicker',
	'type' => 'text'
));
echo $this->Form->end(array(
	'label' => 'Speichern',
	'class' => 'btn btn-default',
)); 
?>
</div>