<h1>Neue Kombination anlegen</h1>
<table class='default-table'>
<?php echo $this->Form->create('Combination', array('type' => 'post')); ?>
<?php echo $this->Form->hidden('customer_id'); ?>
<tr><?php echo $this->Form->input('type_id', array('label' => 'Zugangsdatentyp: ',
	'before' => '<td>',
	'between' => '</td><td>',
	'after' => '</td>'
)); ?></tr>
<tr><?php echo $this->Form->input('username', array(
	'label' => 'Benutzername/Email: ', 
	'before' => '<td>',
	'between' => '</td><td>',
	'after' => '</td>'
)); ?></tr>
<tr><?php echo $this->Form->input('password', array(
	'label' => 'Password: ', 
	'type' => 'text',
	'before' => '<td>',
	'between' => '</td><td>',
	'after' => '</td>'
)); ?></tr>	
<tr><?php echo $this->Form->input('loginurl', array(
	'label' => 'Login URL: ', 
	'type' => 'text',
	'before' => '<td>',
	'between' => '</td><td>',
	'after' => '*</td>'
)); ?></tr>	
<tr><?php echo $this->Form->input('comment', array(
	'label' => 'Zusätzliche Informationen: ',
	'before' => '<td>',
	'between' => '</td><td>',
	'after' => '</td>'
)); ?></tr>
<tr><td></td><td><?php echo $this->Form->end('Kombination speichern'); ?></td></tr>
</table>
