<a href="/" class="logo">Customer Key Chain</a>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Session->flash('auth'); ?>
<div class="login-box">
  <?php

    echo $this->Form->create('User', array('url' => 'login', 'class' => 'panel panel-default')); ?>
    <div class="panel-body">
    <?php
    echo $this->Form->input('username', array(
      'label' => 'Benutzername',
      'class' => 'form-control',
      'div' => array(
        'class' => 'form-group'
      )
    ));
    echo $this->Form->input('password', array(
      'type' => 'password',
      'label' => 'Passwort',
      'class' => 'form-control',
      'div' => array(
        'class' => 'form-group'
      )
    ));
    echo $this->Form->input('stay', array(
      'div' => array(
        'class' => 'checkbox'
      ),
      'type' => 'checkbox',
      'label' => 'Eingeloggt bleiben?'));
    echo $this->Form->button('Login', array('type' => 'submit', 'class' => 'btn btn-primary ckc-btn-login'));
    echo $this->Form->end();
  ?>
</div>