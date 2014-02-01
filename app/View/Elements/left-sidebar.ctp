Favoriten
<ul class="nav nav-pills nav-stacked">
<?php 
foreach ($favorite_customers as $key => $fav_customer) {
    echo "<li>".$this->Html->link($fav_customer['Customer']['name'], array(
    	'controller' => 'customer', 
    	'action' => 'view/'.$fav_customer['Customer']['customer_id']))."</li>";
}
?>
</ul>
<br><br>
Show all
<ul class="nav nav-pills nav-stacked">
<?php 
foreach ($all_customers as $key => $customer) {
    echo "<li>".$this->Html->link($customer['Customer']['name'], array(
    	'controller' => 'customer', 
    	'action' => 'view/'.$customer['Customer']['customer_id']))."</li>";
}
?>
</ul>