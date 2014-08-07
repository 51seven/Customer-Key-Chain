<h2>Kombination bearbeiten</h2>

<?php 
echo $this->Form->create('Combination', array(
	'type' => 'post',
	'role' => 'form',
	'class' => 'form-horizontal'
)); 

echo $this->Form->hidden('customer_id'); 
echo $this->Form->hidden('type_id', array('label' => 'Zugangsdatentyp: '));

echo $this->Form->input('username', array(
	'label' => array(
		'text' => 'Benutzername'
	),
));
echo $this->Form->input('password', array(
	'label' => array(
		'text' => 'Passwort'
	),
));
echo $this->Form->input('loginurl', array(
	'label' => array(
		'text' => 'Login'
	),
));
echo $this->Form->input('comment', array(
	'label' => array(
		'text' => 'Kommentar'
	),
)); 
echo $this->Form->input('tags', array(
	'label' => array(
		'text' => 'Tags'
	),
	'type' => 'text',
	'id' => 'tag-input',
	'placeholder' => 'Type your tag...'
)); 

echo $this->Form->end(array(
	'label' => 'Speichern',
	'class' => 'btn btn-success',
)); 

echo $this->Html->script('tagger.js'); 

?>
<script type="text/javascript">
	// https://github.com/aehlke/tag-it
	$(function() {
        $("#tag-input").tagit({
        	availableTags: [<?= $tags; ?>],
        	autocomplete: { delay: 0 },
        	preprocessTag: function(val) {
	  			return val.toLowerCase();
	  		},
        });

        <?php 
        // Parsing the already asigned tags in the tagger
        foreach ($assignedtags as $tag) {
        	echo '$("#tag-input").tagit("createTag", "'.$tag.'");';
        }
        ?>
    });
</script>



