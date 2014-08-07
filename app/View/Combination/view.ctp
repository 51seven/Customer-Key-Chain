<div class="panel panel-default ckc-combination-panel">
	<div class="panel-heading">
    <h2 class="panel-title"><?= $combination['Type']['name']." von ".$combination['Customer']['name']; ?></h2>
  </div>
  <div class="panel-body">
    <label>Username</label>
      <div class="input-group ckc-input-group">
        <input type="text" readonly value="<?= $combination['Combination']['username']; ?>" class="form-control ckc-read-input">
        <span class="input-group-btn">
          <button class="btn btn-default ckc-button-copy copy-clipboard" data-clipboard-text="<?= $combination['Combination']['username']; ?>" type="button">
          <span class="octicon octicon-clippy"></span>
          </button>
        </span>
      </div>
     <label>Password</label>
      <div class="input-group ckc-input-group">
        <input type="text" readonly value="<?= $combination['Combination']['password']; ?>" class="form-control ckc-read-input">
        <span class="input-group-btn">
          <button class="btn btn-default ckc-button-copy copy-clipboard" data-clipboard-text="<?= $combination['Combination']['password']; ?>" type="button">
          <span class="octicon octicon-clippy"></span>
          </button>
        </span>
      </div>
      <label>Login</label>
        <div class="input-group ckc-input-group">
          <input type="text" readonly value="<?= $combination['Combination']['loginurl']; ?>" class="form-control ckc-read-input">
          <span class="input-group-btn">
            <button class="btn btn-default ckc-button-copy copy-clipboard" data-clipboard-text="<?= $combination['Combination']['loginurl']; ?>" type="button">
              <span class="octicon octicon-clippy"></span>
            </button>
          </span>
        </div>
      <?php if(!in_array($combination['Type']['name'], array('FTP', 'Datenbank', 'Root-Server'))): ?>
        <div class="ckc-input-group">
          <a href="<?= $combination['Combination']['loginurl']; ?>" target="_blank" class="btn btn-primary ckc-read-input">Login</a>
        </div>
      <?php endif; ?>
      </div>
      <?php if($combination['Combination']['comment']): ?>
        <div class="panel-footer ckc-panel-footer"><?= nl2br($combination['Combination']['comment']); ?></div>
      <?php endif; ?>
    </div>
    
    <?php
    echo $this->Form->input('tags', array(
      'label' => array(
        'text' => 'Tags'
      ),
      'type' => 'text',
      'id' => 'tag-input',
    )); ?>
    
    
	<div class="btn-group">
  <?php
	echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span> Bearbeiten', array(
		'controller' => 'combination',
		'action' => 'edit/'.$combination['Combination']['combination_id']
		),
		array('escape' => false, 'class' => 'btn btn-warning')
	);
	echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span> Löschen', array(
		'controller' => 'combination',
		'action' => 'delete', $combination['Combination']['combination_id'],
		),
		array('escape' => false, 'class' => 'btn btn-danger'),
		"Willst du diesen Kunden wirklich entfernen?"
	);
	?>
  </div>

<script type="text/javascript">
  // https://github.com/aehlke/tag-it
  $(function() {
        $("#tag-input").tagit({
          readOnly: true
        });

        <?php 
        // Parsing the already asigned tags in the tagger
        foreach ($assignedtags as $tag) {
          echo '$("#tag-input").tagit("createTag", "'.$tag.'");';
        }
        ?>
    });
</script>
