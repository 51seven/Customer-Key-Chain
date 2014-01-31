Favoriten
<ul class="nav nav-pills nav-stacked">
<?php 
foreach ($favorite_customers as $key => $fav_customer) {
    echo "<li>".$this->Html->link($fav_customer, array('controller' => 'customer', 'action' => 'view/'.$key))."</li>";
}
?>
</ul>
<br><br>
Show all
<ul class="nav nav-pills nav-stacked">
<?php 
foreach ($all_customers as $key => $customer) {
    echo "<li>".$this->Html->link($customer, array('controller' => 'customer', 'action' => 'view/'.$key))."</li>";
}
?>
</ul>