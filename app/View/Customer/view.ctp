<h1><?php echo $customer['Customer']['name']; ?></h1>
<p>
  <?php
    if($isadmin) {
      echo $this->Html->link('Account hinzufügen',
        array(
          'controller' => 'combination', 
          'action' => 'create', $customer['Customer']['customer_id'],
        ),
        array(
          'class' => 'btn-sm btn-primary'
        )
      );
    }

    echo $this->Html->link('Favorit',
      array(
        'controller' => 'user', 
        'action' => 'favorite', $customer['Customer']['customer_id'],
      ),
      array(
        'class' => 'btn-sm btn-info'
      )
    );

    if($isadmin) {
      echo $this->Html->link('Bearbeiten',
        array(
          'controller' => 'customer', 
          'action' => 'edit', $customer['Customer']['customer_id'],
        ),
        array(
          'class' => 'btn-sm btn-warning'
        )
      );
    
      echo $this->Html->link('Löschen',
        array(
          'controller' => 'customer', 
          'action' => 'delete', $customer['Customer']['customer_id'],
        ),
        array(
          'class' => 'btn-sm btn-danger'
        )
      );
    }
  ?>
</p>
<?php
if(sizeof($combinations) > 0) {
  foreach ($combinations as $key => $combination) {
    echo '<h3>'.$combination['Type']['name'].'</h3>';
    ?>
    <table class="default-table align-left">
    <?php
    echo '<tr><td><b>Benutzername:</b></td><td>'.$combination['Combination']['username']."</td></tr>";
    echo '<tr><td><b>Passwort:</b></td><td>'.$combination['Combination']['password']."</td></tr>";
    if($combination['Combination']['loginurl'] != null) {
      echo '<tr><td><b>Login URL:</b></td><td>'.$this->Html->link(
        $combination['Combination']['loginurl'], 
        'http://'.$combination['Combination']['loginurl'],
        array('target' => '_blank')
      )."</td></tr>";
    }
    echo '<tr><td><b>Kommentar:</b></td><td>'.$combination['Combination']['comment']."</td></tr>";

    if($isadmin) {
      echo '<tr><td>'.$this->Html->link('Bearbeiten', array(
        'controller' => 'combination',
        'action' => 'edit/'.$combination['Combination']['combination_id']
      )).'</td>';
      echo '<td>'.$this->Html->link('Löschen', array(
        'controller' => 'combination',
        'action' => 'delete/'.$combination['Combination']['combination_id']
      )).'</td><td></tr>';
    }
    ?>
    </table>
    <hr>
  <?php

  }
}
else {
  echo "<br><br>Für diesen Kunden sind noch keine Kombinationen gespeichert.";
}
?>



