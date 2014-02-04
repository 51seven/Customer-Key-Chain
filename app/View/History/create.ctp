<h1>Neuen Eintrag erstellen</h1>
<?php
echo $this->Form->create('History', array(
	'type' => 'post'
));
echo $this->Form->input('text', array(
	'label' => 'Text: ', 
));
echo $this->Form->input('time', array(
	'label' => 'Zeit: ', 
));
echo $this->Form->end('Eintrag erstellen'); 
?>