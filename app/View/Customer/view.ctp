<div class="page-header ckc-page-header">
  <div class="btn-group pull-right">
    <div class="btn-group">
      <button type="button" class="btn btn-default dropdown-toggle <?php echo (($isadmin) ? '' : 'disabled'); ?>"data-toggle="dropdown"> Hinzufügen <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu">
      <?php
      echo "<li>".$this->Html->link(' History',
        array('controller' => 'history', 'action' => 'create', $customer['Customer']['customer_id']),
        array(
          'title' => 'Neuen Eintrag hinzufügen',
          'escape' => false,
          'class' => 'glyphicon glyphicon-inbox'
        ))."</li>";
      echo "<li>".$this->Html->link(' Ansprechpartner',
        array('controller' => 'contactperson', 'action' => 'create', $customer['Customer']['customer_id']),
        array(
          'title' => 'Neuen Ansprechpartner hinzufügen',
          'escape' => false,
          'class' => 'glyphicon glyphicon-user'
        ))."</li>";
      echo "<li>".$this->Html->link(' Kombination',
        array('controller' => 'combination', 'action' => 'create', $customer['Customer']['customer_id']),
        array(
          'title' => 'Neue Kombination hinzufügen',
          'escape' => false,
          'class' => 'glyphicon glyphicon-lock'
        ))."</li>";
      echo "<li>".$this->Html->link(' Funfact',
        array('controller' => 'funfact', 'action' => 'create', $customer['Customer']['customer_id']),
        array(
          'title' => 'Neuen Funfact hinzufügen',
          'escape' => false,
          'class' => 'glyphicon glyphicon-comment'
        ))."</li>";
      ?>
      </ul>
    </div>
    <div class="btn-group">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
      Anzeigen <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu">
      <?php
        echo "<li>".$this->Html->link(' History',
        array('controller' => 'history', 'action' => 'listall', $customer['Customer']['customer_id']),
        array(
          'title' => 'History ansehen',
          'escape' => false,
          'class' => 'glyphicon glyphicon-inbox'
        ))."</li>";
        echo "<li>".$this->Html->link(' Ansprechpartner',
          array('controller' => 'contactperson', 'action' => 'listall', $customer['Customer']['customer_id']),
          array(
            'title' => 'Ansprechpartner anzeigen',
            'escape' => false,
            'class' => 'glyphicon glyphicon-user'
          ))."</li>";
      ?>
      </ul>
    </div>
    <div class="btn-group">
      <?php
      echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>',
        array('controller' => 'customer', 'action' => 'edit', $customer['Customer']['customer_id']),
        array(
          'escape' => false,
          'class' => "btn btn-default ".(($isadmin) ? '' : 'disabled')
        )
      ); 
      echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>',
        array('controller' => 'customer', 'action' => 'delete', $customer['Customer']['customer_id']),
        array(
          'escape' => false,
          'class' => "btn btn-default ".(($isadmin) ? '' : 'disabled')
        ), "Willst du diesen Kunden wirklich entfernen?"
      );
      ?>
    </div>
  </div>

  <h1>
  <?php
    echo $customer['Customer']['name']; 
      if($isfav) $addClass = 'glyphicon-star';
      else $addClass = 'glyphicon-star-empty';
      echo $this->Html->link('',
        array('controller' => 'user', 'action' => 'favorite', $customer['Customer']['customer_id']),
        array('class' => 'ckc-fav-icon glyphicon '.$addClass
        )
      );
    ?>
  </h1>

  <?php 
  if(isset($funfact['Funfact']['text'])) {
    echo "<blockquote>\"".$funfact['Funfact']['text']."\"</blockquote>";
  }
  else {
    echo "Dieser Kunde ist in Ordnung. ";
    echo $this->Html->link('doch nicht?', array(
      'controller' => 'funfact', 
        'action' => 'create', $customer['Customer']['customer_id'],
      )
    );
  }
  ?>
</div>

<?php
// Liste alle Kundenkombinationen auf
if(sizeof($combinations) > 0):

  foreach ($combinations as $key => $combinationtype): ?>
    <h3><?= $key; ?></h3>
    <div class="row">

    <?php foreach ($combinationtype as $col): ?>
    <div class="col-md-4">
    <?php foreach ($col as $combination): ?>

      <div class="ckc-panel-group">
        <div class="panel panel-default ckc-combination-panel">
          <div class="panel-heading">
            <?php $title = strtok($combination['comment'], "\n"); ?>
            <?php if(strlen($title) > 26) $title = substr($title, 0, 20) . '...'; ?>
            <?php if(empty($title)) $title = $combination['username']; ?>
            <?php if($key == 'Email') $title = $combination['username']; ?>
            <h4 class="panel-title"><?= $title; ?></h4>
          </div>
          <div class="panel-body">
            <?php if($combination['username']): ?>
            <div class="input-group ckc-input-group">
              <input type="text" readonly value="<?= $combination['username']; ?>" class="form-control ckc-read-input">
              <span class="input-group-btn">
                <button class="btn btn-default ckc-button-copy copy-clipboard" data-clipboard-text="<?= $combination['username']; ?>" type="button">
                  <span class="glyphicon glyphicon-user"></span>
                </button>
              </span>
            </div>
            <?php endif; ?>
            <?php if($combination['password']): ?>
            <div class="input-group ckc-input-group">
              <input type="text" readonly value="<?= $combination['password']; ?>" class="form-control ckc-read-input">
              <span class="input-group-btn">
                <button class="btn btn-default ckc-button-copy copy-clipboard" data-clipboard-text="<?= $combination['password']; ?>" type="button">
                  <span class="octicon octicon-key"></span>
                </button>
              </span>
            </div>
          <?php endif; ?>
          <?php if($combination['loginurl']): ?>
            <div class="input-group ckc-input-group">
              <input type="text" readonly value="<?= $combination['loginurl']; ?>" class="form-control ckc-read-input">
              <span class="input-group-btn">
                <button class="btn btn-default ckc-button-copy copy-clipboard" data-clipboard-text="<?= $combination['loginurl']; ?>" type="button">
                  <span class="octicon octicon-lock"></span>
                </button>
              </span>
            </div>
<?php if(!in_array($key, array('FTP', 'Datenbank', 'Root-Server'))): ?>
            <div class="ckc-input-group">
              <a href="<?php echo $combination['loginurl']; ?>" target="_blank" class="btn btn-primary ckc-read-input">Login</a>
            </div>
<?php endif; ?>
<?php endif; ?>
            
          </div>
          <?php if(($combination['comment'] && (substr_count($combination['comment'], "\n") > 0 && strlen($combination['comment']) > 26)) || ($key == 'Email' && $combination['comment'])): ?>
          <div class="panel-footer ckc-panel-footer is-clickable is-collapsed"><?= nl2br($combination['comment']); ?></div>
          <?php endif; ?>
        </div>
        <div class='btn-group btn-group-vertical ckc-combination-tools'>
        <?php
          // Anzeigen
          echo $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', 
                array('controller' => 'combination', 'action' => 'view', $combination['combination_id']), 
                array('escape' => false, 'class' => 'ckc-action-btn btn btn-primary btn-xs'));
          // Bearbeiten
          echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', 
                array('controller' => 'combination', 'action' => 'edit', $combination['combination_id']), 
                array('escape' => false, 'class' => 'ckc-action-btn btn btn-warning btn-xs'));
          // Löschen
          echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>', 
                array('controller' => 'combination', 'action' => 'delete', $combination['combination_id']), 
                array('escape' => false, 'class' => 'ckc-action-btn btn btn-danger btn-xs'), "Willst du diesen Account wirklich entfernen?"); ?>
          </div>
        </div>
      <?php endforeach; // End for every panel ?>
      </div>
    <?php endforeach; // End for panel-col ?>
    </div>
  <?php endforeach;
  else:
  ?>
  <div class="alert alert-info">Für diesen Kunden sind noch keine Accounts gespeichert.</div>
<?php endif; ?>
