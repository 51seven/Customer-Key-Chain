<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/Customer-Key-Chain">Customer Key Chain</a>
    </div>
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <?php echo "<li>".$this->Html->link('Kunde anlegen', array('controller' => 'customer', 'action' => 'create'))."</li>"; ?>
          <?php echo "<li>".$this->Html->link('Typ anlegen', array('controller' => 'type', 'action' => 'create'))."</li>"; ?>
          <?php 
            if($this->Session->check('Auth.User')) {
              echo "<li>".$this->Html->link('Logout', array('controller' => 'user', 'action' => 'logout'))."</li>"; 
            }
          ?>
      </ul>
      <?php echo $this->Form->create(null, array('url' => array('controller' => 'customer', 'action' => 'search'), 
        'type' => 'get',  
        'inputDefaults' => array(
          'div' => array('class' => 'form-group')
        ),
        'class' => 'navbar-form navbar-left',
      )); ?>
      <?php echo $this->Form->input('string', array('label' => false, 'placeholder' => 'Suchen...', 'class' => 'site-search form-control')); ?>
      <?php echo $this->Form->button('Suchen', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</nav>