<div class="fluid-container">
	<div class="row">
		<div class="col-md-6 col-md-offset-1">
		<?php
			echo $this->Session->flash('auth'); // check if needed ?

			echo $this->Form->create('User', array('url' => 'login', 'class' => 'panel panel-default')); ?>
			<div class="panel-heading"><h3 class="panel-title">Login</h3></div>
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
			echo $this->Form->button('Login', array('type' => 'submit', 'class' => 'btn btn-primary'));
			echo $this->Form->end();
			?>
		</div>
	</div>
</div>