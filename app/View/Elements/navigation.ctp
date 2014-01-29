<div class='navigation'>
<?php
echo $this->Html->link('Alle Kunden', array(
  'controller' => 'customer',
  'action' => 'index'
));
echo " | ";
echo $this->Html->link('Neuer Kunde', array(
  'controller' => 'customer',
  'action' => 'create'
));
echo " | ";
echo $this->Html->link('Neue Kombination', array(
  'controller' => 'combination',
  'action' => 'create'
));

// Suchformular
echo $this->Form->create(null, array(
    'url' => array(
      'controller' => 'customer', 
      'action' => 'search'
    ),
    'type' => 'get'
));
echo $this->Form->input('string', array(
  'label' => 'Kunden durchsuchen: ',
));
echo $this->Form->end('suchen');
echo "<hr>";
?>
</div>