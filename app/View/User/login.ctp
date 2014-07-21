<a href="/" class="logo">Customer Key Chain</a>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Session->flash('auth'); ?>
<div class="login-box">
  <?php
    echo $this->Form->create('User', array(
      'url' => 'login', 
      'role' => 'form',
      'class' => 'panel panel-default form'
    )); ?>
    <div class="panel-body">
      <?php
      echo $this->Form->input('username', array(
        'label' => 'Benutzername',
      ));
      echo $this->Form->input('password', array(
        'type' => 'password',
        'label' => 'Passwort',
      )); ?>
      <div class="checkbox">
        <label>
        <?php // This markup is from bootstrap, don't judge me
        echo $this->Form->input('stay', array(
          'div' => false,
          'type' => 'checkbox',
          'label' => false
        )); ?>
        Keep me logged in
        </label>
      </div>
      <?php
      echo $this->Form->button('Login', array(
        'type' => 'submit', 'class' => 'btn btn-primary ckc-btn-login'));
      echo $this->Form->end();
    ?>
    </div>
</div>