<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Changer le mot de passe') ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', 'Changer le mot de passe') ?>

<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('password', array('label' => 'Nouveau mot de passe', 'value' => false)) ?>
<?php echo $this->Form->input('password_confirm', array('type' => 'password', 'label' => 'Confirmation du nouveau mot de passe', 'value' => false)) ?>
<?php echo $this->Form->end("Changer le mot de passe") ?>
