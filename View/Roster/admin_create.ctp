<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Roster de la guilde", array('action' => 'index')) ?>
<?php $this->Html->addCrumb("Ajouter un personnage") ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Ajouter un personnage') ?>

<?= $this->Form->create() ?>
<?= $this->Form->input('id', array('label' => 'Nom', 'options' => $characters)) ?>
<?= $this->Form->end('Ajouter') ?>
