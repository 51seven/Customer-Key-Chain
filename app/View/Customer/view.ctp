<div class="page-header ckc-page-header">
  <div class="btn-group pull-right">
  <?php
  if($isadmin):
      echo $this->Html->link('<span class="glyphicon glyphicon-inbox"></span>',
        array(
          'controller' => 'history', 
          'action' => 'create', $customer['Customer']['customer_id'],
        ),
        array(
          'title' => 'Neuen Eintrag hinzufügen',
          'escape' => false,
          'class' => 'btn btn-success'
        )
      );
      echo $this->Html->link('<span class="glyphicon glyphicon-user"></span>',
        array(
          'controller' => 'contactperson', 
          'action' => 'create', $customer['Customer']['customer_id'],
        ),
        array(
          'title' => 'Neuen Ansprechpartner hinzufügen',
          'escape' => false,
          'class' => 'btn btn-success'
        )
      );
   ?> 
   <?php
      echo $this->Html->link('<span class="glyphicon glyphicon-lock"></span>',
        array(
          'controller' => 'combination', 
          'action' => 'create', $customer['Customer']['customer_id'],
        ),
        array(
          'title' => 'Neue Kombination hinzufügen',
          'escape' => false,
          'class' => 'btn btn-success'
        )
      );
  ?>
  <?php
    echo $this->Html->link('<span class="glyphicon glyphicon-comment"></span>',
      array(
        'controller' => 'funfact', 
        'action' => 'create', $customer['Customer']['customer_id'],
      ),
      array(
        'title' => 'Neuen Funfact hinzufügen',
        'escape' => false,
        'class' => 'btn btn-success'
      )
    );
  ?>
  <?php 
  echo $this->Html->link('<span class="glyphicon glyphicon-list-alt"></span>',
    array(
      'controller' => 'customer', 
      'action' => 'history', $customer['Customer']['customer_id'],
    ),
    array(
      'title' => 'History ansehen',
      'escape' => false,
      'class' => 'btn btn-primary'
    )
  );
  echo $this->Html->link('<span class="glyphicon glyphicon-book"></span>',
    array(
      'controller' => 'customer', 
      'action' => 'contacts', $customer['Customer']['customer_id'],
    ),
    array(
      'title' => 'Kontaktpersonen anzeigen',
      'escape' => false,
      'class' => 'btn btn-primary'
    )
  );

  ?>
  <?php
      echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>',
        array(
          'controller' => 'customer', 
          'action' => 'edit', $customer['Customer']['customer_id'],
        ),
        array(
          'escape' => false,
          'class' => 'btn btn-warning'
        )
      );
  ?>
  <?php  
      echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>',
        array(
          'controller' => 'customer', 
          'action' => 'delete', $customer['Customer']['customer_id'],
        ),
        array(
          'escape' => false,
          'class' => 'btn btn-danger'
        ), "Willst du diesen Kunden wirklich entfernen?"
      );
    endif;
  ?>
</div>
  <h1>
    <?php echo $customer['Customer']['name']; ?>
    <?php
      if($isfav)
        $addClass = 'glyphicon-star';
      else
        $addClass = 'glyphicon-star-empty';
      echo $this->Html->link('',
        array(
          'controller' => 'user', 
          'action' => 'favorite', $customer['Customer']['customer_id'],
        ),
        array(
          'class' => 'ckc-fav-icon glyphicon '.$addClass
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
  foreach ($combinations as $key => $combinationtype):
    ?>
    <h2 class="col-md-12"><?php echo $key; ?></h2>
    <?php foreach ($combinationtype as $combination): ?>
      <div class="col-md-4">
        <div class="ckc-account">
        <div class="ckc-view-panel">
        <?php if($isadmin): ?>
          <div class="btn-group ckc-view-btn-group">
          <?php
            echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', array(
              'controller' => 'combination',
              'action' => 'edit',
              $combination['combination_id']
            ), array('escape' => false, 'class' => 'ckc-action-btn btn btn-warning btn-xs'));
          ?>
          <?php
            echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
              'controller' => 'combination',
              'action' => 'delete',
              $combination['combination_id']
            ), array('escape' => false, 'class' => 'ckc-action-btn btn btn-danger btn-xs'), "Willst du diesen Account   wirklich entfernen?"
            );
          ?>
          </div>
        <?php endif; ?>
          <label>Benutzer</label>
          <div class="input-group ckc-input-group-username">
            <input type="text" readonly="readonly" value="<?php echo $combination['username']; ?>" class="form-control">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-import"></span></button>
            </span>
          </div>
          <label>Passwort</label>
          <div class="input-group ckc-input-group-password">
            <input type="text" readonly="readonly" value="<?php echo $combination['password']; ?>" class="form-control">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-import"></span></button>
            </span>
          </div>
        </div>
        <?php if($combination['loginurl']): ?>
        <div class="ckc-loginurl">
          <a href="//<?php echo $combination['loginurl']; ?>" target="_blank"><?php echo $combination['loginurl']; ?></a>
        </div>
        <?php endif; ?>
        <div class="ckc-comment">
          <?php echo $this->Markdown->transform($combination['comment']); ?>
        </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endforeach; else: ?>
  <div class="alert alert-info">Für diesen Kunden sind noch keine Accounts gespeichert.</div>
<?php endif; ?>