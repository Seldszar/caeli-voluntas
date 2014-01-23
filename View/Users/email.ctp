<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Changer d'adresse e-mail") ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', "Changer d'adresse e-mail") ?>

<?= $this->Form->create() ?>
<?= $this->Form->input('email', array('label' => 'Nouvelle adresse e-mail', 'value' => false)) ?>
<?= $this->Form->input('email_confirm', array('label' => 'Confirmation de la nouvelle adresse e-mail', 'value' => false)) ?>
<?= $this->Form->end("Changer d'adresse e-mail") ?>
