<h1><?php echo $this->request->data['Customer']['name']; ?> bearbeiten</h1>
<?php
echo $this->Form->create('Customer', array(
	'type' => 'post'
	)
);
echo $this->Form->input('name', array(
	'label' => 'Name des Kunden: ', 
));
echo $this->Form->input('isfavorite', array(
	'label' => 'als Favorit markieren',
	'type' => 'checkbox'
));
echo $this->Form->end('speichern'); 
?>