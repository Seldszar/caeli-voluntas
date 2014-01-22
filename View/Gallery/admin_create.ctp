<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Galerie', array('action' => 'index')) ?>
<?php $this->Html->addCrumb('Ajouter une image') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Ajouter une image') ?>

<?= $this->Form->create(array('type' => 'file')) ?>
<?= $this->Form->input('image', array('type' => 'file', 'label' => 'Image')) ?>
<?= $this->Form->input('caption', array('label' => 'Légende')) ?>
<?= $this->Form->end("Sauver") ?>
