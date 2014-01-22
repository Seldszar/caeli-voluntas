<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Changer le mot de passe') ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', 'Changer le mot de passe') ?>

<?= $this->Form->create() ?>
<?= $this->Form->input('password', array('label' => 'Nouveau mot de passe', 'value' => false)) ?>
<?= $this->Form->input('password_confirm', array('type' => 'password', 'label' => 'Confirmation du nouveau mot de passe', 'value' => false)) ?>
<?= $this->Form->end("Changer le mot de passe") ?>
