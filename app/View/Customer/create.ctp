<h1>Neuen Kunden anlegen</h1>


<?php
echo $this->Form->create('Customer', array(
	'type' => 'post'
	)
);
echo $this->Form->input('name', array(
	'label' => 'Name des Kunden: ', 
	)
);
echo $this->Form->end('Kunde anlegen'); 
?>