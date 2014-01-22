<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Galerie', array('action' => 'index')) ?>
<?php $this->Html->addCrumb('Ajouter une image') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Ajouter une image') ?>

<?php echo $this->Form->create(array('type' => 'file')) ?>
<?php echo $this->Form->input('image', array('type' => 'file', 'label' => 'Image')) ?>
<?php echo $this->Form->input('caption', array('label' => 'Légende')) ?>
<?php echo $this->Form->end("Sauver") ?>
