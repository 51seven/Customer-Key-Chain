<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <?php 
  	echo h($message); 
  	if(isset($link_text) && isset($link_url)) {
  		echo $this->Html->link($link_text, $link_url, array("escape" => false));
  	}
  ?>
</div>