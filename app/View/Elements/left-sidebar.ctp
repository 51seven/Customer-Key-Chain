<div class='left-sidebar'>
<h3>Alle Kunden</h3>
<ul>
<?php
foreach ($all_customers as $key => $customer) {
  echo "<li>".$this->Html->link($customer, array(
    'controller' => 'customer', 
    'action' => 'view/'.$key
    ))."</li>";
}
?>
</ul>
</div>