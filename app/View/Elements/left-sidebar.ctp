<ul class="nav nav-pills nav-stacked">
  <?php
    foreach ($all_customers as $key => $customer) {
      echo "<li>";
      echo $this->Html->link($customer, array(
        'controller' => 'customer', 
        'action' => 'view/'.$key
        ));
      echo "</li>";
    }
  ?>
</ul>