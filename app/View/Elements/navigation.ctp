<div class='navigation'>
<ul>
  <li>
    <?php echo $this->Html->link('Alle Kunden', array('controller' => 'customer', 'action' => 'index')); ?>
  </li>
  <li>
    <?php echo $this->Html->link('Neuer Kunde', array('controller' => 'customer', 'action' => 'create')); ?>
  </li>
  <li>
    <?php echo $this->Html->link('Neue Kombination', array('controller' => 'combination', 'action' => 'create')); ?>
  </li>
  <li>
  <span class='search'>
    <?php echo $this->Form->create(null, array('url' => array('controller' => 'customer', 'action' => 'search'), 
      'type' => 'get',  
      'inputDefaults' => array(
        'div' => false,
      )
    )); ?>
    <?php echo $this->Form->input('string', array('label' => 'Suche: ')); ?>
    <?php echo $this->Form->end(array('div'=>false,'text'=>'Search')); ?>
    <!-- some test comment for commit -->
    </span>
  </li>
</ul>
</div>