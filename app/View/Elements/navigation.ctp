<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?= $this->Html->link('Customer Key Chain', array('controller' => 'pages', 'action' => 'index'), array('class' => 'navbar-brand')); ?>
    </div>
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <?php if($isadmin) echo "<li>".$this->Html->link('Kunde anlegen', array('controller' => 'customer', 'action' => 'create'))."</li>"; ?>
          <?php if($isadmin) echo "<li>".$this->Html->link('Typ anlegen', array('controller' => 'type', 'action' => 'create'))."</li>"; ?>
          <?php 
            echo "<li>".$this->Html->link('Logout', array('controller' => 'user', 'action' => 'logout'))."</li>"; 
          ?>
      </ul>
      <?php echo $this->Form->create(null, array('url' => array('controller' => 'customer', 'action' => 'search'), 
        'type' => 'get',  
        'inputDefaults' => array(
          'div' => false
        ),
        'class' => 'navbar-form navbar-left pull-right ckc-search-form',
        'role' => 'search'
      )); ?>
      <div class="input-group">
      <?php echo $this->Form->input('string', array('label' => false, 'placeholder' => 'Suchen...', 'class' => 'site-search form-control pull-right')); ?>
      <span class="input-group-btn">
      <?php echo $this->Form->button('<span class="glyphicon glyphicon-search"></span>', array('escape' => false, 'type' => 'submit', 'class' => 'btn btn-default')); ?>
      </span>
    </div>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</nav>