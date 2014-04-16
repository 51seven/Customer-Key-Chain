<div class="input-group">
<h2>Bitte wähle zuerst einen Kunden aus</h2>
<br>
<?php
echo $this->Form->create('Contactperson', array(
	'type' => 'get',
	'class' => 'form-horizontal',
	'url' => array('controller' => 'contactperson', 'action' => 'create')
));
echo $this->Form->input('cid', array(
    'options' => $customers, 
	'label' => array(
		'text' => 'Kunde '
	),
));
echo $this->Form->end(array(
	'label' => 'Weiter',
	'class' => 'btn btn-default',
)); 
?>
</div>

