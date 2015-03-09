<head>
<?php
	echo $this->Html->css('cake.generic');
?>
</head>
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend>
			<?php echo __('Введите логин и пароль'); ?>
		</legend>
		<?php echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>