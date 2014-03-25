<div class="input-group">
<h1 class="primary">Neuen Zugangstyp anlegen</h1>
<p>Zugangstypen beschreiben die Art des Passwortes. Z.B. Wordpress, FTP...</p><br>
<?php
echo $this->Form->create('Type', array(
	'type' => 'post',
	'class' => 'form-horizontal'
	)
);
echo $this->Form->input('name', array(
	'label' => array(
		'class' => 'col-sm-2 control-label', 
		'text' => 'Name '
	),
	'class' => 'form-control',
	'div' => array('class' => 'form-group'),
	'between' => '<div class="col-sm-10">',
	'after' => '</div>',
));
echo $this->Form->end(array(
	'label' => 'Typ anlegen',
	'class' => 'btn btn-default',
	'div' => array('class' => 'form-group'),
	'before' => '<div class="col-sm-offset-2 col-sm-10">',
	'after' => '</div>',
)); 
?>
</div>