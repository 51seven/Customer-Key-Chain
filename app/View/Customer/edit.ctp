<h2><?php echo $this->request->data['Customer']['name']; ?> bearbeiten</h2>
<?php
echo $this->Form->create('Customer', array(
	'type' => 'post',
	'class' => 'form-horizontal',
));

echo $this->Form->input('name', array(
	'label' => array(
		'text' => 'Name '
	),
));

echo $this->Form->input('tel', array(
	'label' => array(
		'text' => 'Telefon '
	),
));
echo $this->Form->input('street', array(
	'label' => array(
		'text' => 'Straße '
	),
));
echo $this->Form->input('plz', array(
	'label' => array(
		'text' => 'PLZ '
	),
));
echo $this->Form->input('city', array(
	'label' => array(
		'text' => 'Stadt '
	),
));
echo $this->Form->end(array(
	'label' => 'Speichern',
	'class' => 'btn btn-success',
)); 
?>