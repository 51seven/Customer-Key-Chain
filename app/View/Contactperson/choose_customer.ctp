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
		'class' => 'col-sm-2 control-label', 
		'text' => 'Kunde '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->end(array(
	'label' => 'Weiter',
	'class' => 'btn btn-default',
	'div' => array('class' => 'form-group'),
	'before' => '<div class="col-sm-offset-2 col-sm-10">',
	'after' => '</div>',
)); 
?>
</div>

