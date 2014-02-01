<h1 class="ckc-customer-h">
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
<p>
  <?php
    if($isadmin):
      echo $this->Html->link('Account hinzufügen',
        array(
          'controller' => 'combination', 
          'action' => 'create', $customer['Customer']['customer_id'],
        ),
        array(
          'class' => 'btn-sm btn-primary'
        )
      );
  ?>
  <?php
      echo $this->Html->link('Bearbeiten',
        array(
          'controller' => 'customer', 
          'action' => 'edit', $customer['Customer']['customer_id'],
        ),
        array(
          'class' => 'btn-sm btn-warning'
        )
      );
  ?>
  <?php  
      echo $this->Html->link('Löschen',
        array(
          'controller' => 'customer', 
          'action' => 'delete', $customer['Customer']['customer_id'],
        ),
        array(
          'class' => 'btn-sm btn-danger'
        )
      );
    endif;
  ?>
</p>

<?php
if(sizeof($combinations) > 0):
foreach ($combinations as $key => $combinationtype):
?>
    <div class="panel panel-default table-responsive">
      <div class="panel-heading"><?php echo $key; ?></div>
      <table class="ckc-account-table table table-striped table-hover">
        <thead>
          <tr>
            <th class="nr">#</th>
            <?php if($isadmin) { ?><th class="action">&#160;</th><?php } ?>
            <th class="username">Benutzer</th>
            <th class="password">Passwort</th>
            <th class="comment">Info</th>
        </thead>
        <tbody>
<?php $i = 0; foreach ($combinationtype as $combination): $i++; ?>
          <tr>
            <td class="nr"><?php echo $i; ?></td>
            <?php if($isadmin) { ?><td class="action">
            <?php
            echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', array(
              'controller' => 'combination',
              'action' => 'edit',
              $combination['combination_id']
            ), array('escape' => false, 'class' => 'ckc-action-btn btn btn-warning btn-xs')); ?>
            <?php
            echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
              'controller' => 'combination',
              'action' => 'delete',
              $combination['combination_id']
            ), array('escape' => false, 'class' => 'ckc-action-btn btn btn-danger btn-xs'), "Willst du diesen Account wirklich entfernen?"
            ); ?>
            </td><?php } ?>
            <td class="username"><?php echo $combination['username']; ?></td>
            <td class="password"><?php echo $combination['password']; ?></td>
            <td class="comment">
              <?php if($combination['loginurl']): ?>
              <strong>Login: </strong> <a href="//<?php echo $combination['loginurl']; ?>" target="_blank"><?php echo $combination['loginurl']; ?></a><br>
              <?php
                endif;
                echo $combination['comment'];
              ?>
            </td>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </div>
<?php endforeach; else: ?>
  <div class="alert alert-info">Für diesen Kunden sind noch keine Accounts gespeichert.</div>
<?php endif; ?>