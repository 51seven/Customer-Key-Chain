
<?php
echo $this->Session->flash('auth'); // check if needed ?

echo $this->Form->create('User', array('url' => 'login'));
echo $this->Form->input('username', array('label' => 'Benutzername', 'class' => 'standard-input'));
echo $this->Form->input('password', array('type' => 'password', 'label' => 'Passwort', 'class' => 'standard-input'));
echo $this->Form->input('stay', array('type' => 'checkbox', 'label' => 'Eingeloggt bleiben?'));
echo $this->Form->submit('Login', array(
    'div' => false,
    'class' => 'submit-button'
));
echo $this->Form->end();
?>