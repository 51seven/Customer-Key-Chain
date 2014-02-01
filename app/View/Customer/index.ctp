<div class="page-header">
	<h1>Hi! <small><?php echo $user['username']; ?></small></h1>
</div>

Admin: <?php echo $user['isadmin']; ?>

<?php
/*foreach ($customers as $key => $customer) {
	echo $this->Html->link($customer['Customer']['name'], array(
		'controller' => 'customer', 
		'action' => 'view/'.$customer['Customer']['customer_id']
		)
	)."<br>";
}
*/
?>


