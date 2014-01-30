<div class='navigation'>
<ul>
  <li>
    Customer Key Chain
  </li>
  <li>
    <?php echo $this->Html->link('Neuer Kunde', array('controller' => 'customer', 'action' => 'create')); ?>
  </li>
  <li>
    <?php echo $this->Html->link('Neue Kombination', array('controller' => 'combination', 'action' => 'create')); ?>
  </li>
  <li>
    <?php echo $this->Html->link('Neuer Typ', array('controller' => 'type', 'action' => 'create')); ?>
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
    </span>
  </li>
</ul>
</div>