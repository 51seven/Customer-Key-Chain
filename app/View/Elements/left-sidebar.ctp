<div class="panel-group sidebar-accordion" id="sidebarAccordion">
  <div class="list-group">
    <a class="list-group-item ckc-head-item" id="favClick" data-toggle="collapse" data-parent="#sidebarAccordion" href="#favoriten">Favoriten <span class="glyphicon glyphicon-bookmark"></span></a>
    <div id="favoriten" class="panel-collapse collapse <?php if($this->Session->read('NavCollapse.fav')) echo "in"; ?>">
      <?php 
      foreach ($favorite_customers as $key => $fav_customer) {
          echo $this->Html->link($fav_customer['Customer']['name'], array(
            'controller' => 'customer', 
            'action' => 'view/'.$fav_customer['Customer']['customer_id']
          ), array(
            'class' => 'list-group-item'
          ));
      }
      ?>
    </div>
  </div>
  <div class="list-group">
    <a class="list-group-item ckc-head-item" id="allClick" data-toggle="collapse" data-parent="#sidebarAccordion" href="#allCustomers">Alle</a>
    <div id="allCustomers" class="panel-collapse collapse <?php if($this->Session->read('NavCollapse.all')) echo "in"; ?>">
      <?php 
      foreach ($all_customers as $key => $customer) {
          echo $this->Html->link($customer['Customer']['name'], array(
      'controller' => 'customer', 
      'action' => 'view/'.$customer['Customer']['customer_id']), array('class' => 'list-group-item'));
      }
      ?>
    </div>
  </div>
</div>