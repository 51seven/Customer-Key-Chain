<div class="input-group">
<h2 class="primary">Neuen Zugangstyp anlegen</h2>
<p>Zugangstypen beschreiben die Art des Passwortes. Z.B. Wordpress, FTP...</p><br>
<?php
echo $this->Form->create('Type', array(
	'type' => 'post',
	'class' => 'form-horizontal'
	)
);
echo $this->Form->input('name', array(
	'label' => array(
		'text' => 'Name '
	),
));
echo $this->Form->end(array(
	'label' => 'Typ anlegen',
	'class' => 'btn btn-default',
)); 
?>
</div>