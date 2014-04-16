<div class="input-group">
<h1 class="primary">Neue Kontaktperson anlegen</h1>
<?php
echo $this->Form->create('Contactperson', array(
	'type' => 'post',
	'role' => 'form',
	'class' => 'form-horizontal'
));
echo $this->Form->hidden('customer_id');

$title = array('Herr' => 'Herr', 'Frau' => 'Frau');
echo $this->Form->input('title', array(
    'options' => $title, 
	'label' => array(	
		'text' => 'Anrede '
	),
	'wrap' => 'col-sm-4',
));
echo $this->Form->input('prename', array(
	'label' => array(
		'text' => 'Vorname '
	),
));
echo $this->Form->input('name', array(
	'label' => array(	
		'text' => 'Nachname '
	),
));
echo $this->Form->input('phone', array(
	'label' => array(
		'text' => 'Telefon '
	),
));
echo $this->Form->input('mobile', array(
	'label' => array(
		'text' => 'Mobil '
	),
));
echo $this->Form->input('mail', array(
	'label' => array(
		'text' => 'Email '
	),
));
echo $this->Form->end(array(
	'label' => 'Kontaktperson anlegen',
	'class' => 'btn btn-default',
)); 
?>
</div>