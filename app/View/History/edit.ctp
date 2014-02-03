<h1>Eintrag bearbeiten</h1>
<?php
echo $this->Form->create('History', array(
	'type' => 'post'
));
echo $this->Form->hidden('history_id');
echo $this->Form->hidden('customer_id');
echo $this->Form->input('text', array(
	'label' => 'Text: ', 
));
echo $this->Form->input('time', array(
	'label' => 'Zeit: ', 
));
echo $this->Form->end('speichern'); 
?>