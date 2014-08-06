<div class="input-group">
<h2 class="primary">Neues Tag erstellen</h2>
<?php
echo $this->Form->create('Tag', array(
	'type' => 'post',
	'class' => 'form-inline'
	)
);
echo $this->Form->input('name', array(
	'label' => array(
		'text' => 'Tag '
	),
	'type' => 'text'
));
echo $this->Form->end(array(
	'label' => 'Tag anlegen',
	'class' => 'btn btn-default',
)); 
?>
</div>