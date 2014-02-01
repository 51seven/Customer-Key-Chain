<div class="panel-group sidebar-accordion" id="sidebarAccordion">
  <div class="list-group">
    <a class="list-group-item ckc-head-item" data-toggle="collapse" data-parent="#sidebarAccordion" href="#favoriten">Favoriten <span class="glyphicon glyphicon-bookmark"></span></a>
    <div id="favoriten" class="panel-collapse collapse">
      <?php 
      foreach ($favorite_customers as $key => $fav_customer) {
          echo $this->Html->link($fav_customer, array('controller' => 'customer', 'action' => 'view/'.$key), array('class' => 'list-group-item'));
      }
      ?>
    </div>
  </div>
  <div class="list-group">
    <a class="list-group-item ckc-head-item" data-toggle="collapse" data-parent="#sidebarAccordion" href="#allCustomers">Alle</a>
    <div id="allCustomers" class="panel-collapse collapse in">
      <?php 
      foreach ($all_customers as $key => $customer) {
          echo $this->Html->link($customer, array('controller' => 'customer', 'action' => 'view/'.$key), array('class' => 'list-group-item'));
      }
      ?>
    </div>
  </div>
</div>