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

  echo "<table class='table table-striped table-responsive table-hover'>";
      echo "<tr>";
        echo "<th>Type</th>";
        echo "<th>Username</th>";
        echo "<th>Password</th>";
        echo "<th>LoginURL</th>";
        echo "<th></th>";
      echo "</tr>";
  foreach ($combinations as $key => $combinationtype) {
    foreach ($combinationtype as $key2 => $combination) {
      echo "<tr>";
        echo "<td>".$key."</td>";
        echo "<td>".$combination['username']."</td>";
        echo "<td>".$combination['password']."</td>";
        ?><td><a href="//<?php echo $combination['loginurl']; ?>" target="_blank"><?php echo $combination['loginurl']; ?></a></td><?php
        echo "<td><div class='btn-group'>";
          // Anzeigen
          echo $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', 
                array('controller' => 'combination', 'action' => 'view', $combination['combination_id']), 
                array('escape' => false, 'class' => 'ckc-action-btn btn btn-default btn-xs'));
          // Bearbeiten
          echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', 
                array('controller' => 'combination', 'action' => 'edit', $combination['combination_id']), 
                array('escape' => false, 'class' => 'ckc-action-btn btn btn-default btn-xs'));
          // Löschen
          echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>', 
                array('controller' => 'combination', 'action' => 'delete', $combination['combination_id']), 
                array('escape' => false, 'class' => 'ckc-action-btn btn btn-default btn-xs'), "Willst du diesen Account wirklich entfernen?");
        echo "</div></td>";
      echo "</tr>";
    }
  }
  echo "</table>";
  else:
  ?>
  <div class="alert alert-info">Für diesen Kunden sind noch keine Accounts gespeichert.</div>
<?php endif; ?>
