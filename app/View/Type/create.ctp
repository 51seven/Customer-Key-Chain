<h1>Neuen Type anlegen</h1>
<?php
echo $this->Form->create('Type', array(
	'type' => 'post'
	)
);
echo $this->Form->input('name', array(
	'label' => 'Name des Typen: ', 
));
echo $this->Form->end('Typ anlegen'); 
?>