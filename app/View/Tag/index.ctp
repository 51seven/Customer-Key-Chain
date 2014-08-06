<div class="row">
	<div class="col-sm-6">
		<h3>Alle Tags:</h3>
	</div>
	<div class="col-sm-6">
		<div class="input-group">
		<?php
			echo $this->Form->create('Tag', array(
				'type' => 'post',
				'class' => 'form-inline',
				'url' => '/tag/create'
			));
			echo $this->Form->input('name', array(
				'placeholder' => 'new tag...'
			));
			echo $this->Form->end(array(
				'label' => 'Create',
				'class' => 'btn btn-default',
			)); 
		?>
		</div>
	</div>
</div>

<?php
foreach ($tags as $key => $tag) {
	echo $tag." ";
	echo $this->Html->link('', 
		array('action' => 'edit', $key), 
		array('class' => array(
			'edit', 'glyphicon', 'glyphicon-pencil')
		)
	)." ";
	echo $this->Html->link('', 
		array('action' => 'delete', $key), 
		array('class' => array(
			'edit', 'glyphicon', 'glyphicon-trash')
		), "Diesen Typ wirklich entfernen?\nDazu darf kein Kunde diesen Typ benutzen."
	)."<br>";
}


?>