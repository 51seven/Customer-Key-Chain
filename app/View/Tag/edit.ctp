<div class="input-group">
<h2 class="primary">Tag bearbeiten</h2>
<?php
echo $this->Form->create('Tag', array(
	'type' => 'post',
	'class' => 'form-inline'
	)
);
echo $this->Form->hidden('tag_id');
echo $this->Form->input('name', array(
	'label' => array(
		'text' => 'Name '
	),
));
echo $this->Form->end(array(
	'label' => 'Speichern',
	'class' => 'btn btn-default',
)); 
?>
</div>