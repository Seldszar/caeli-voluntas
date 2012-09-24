<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Roster de la guilde", array('action' => 'index')) ?>
<?php $this->Html->addCrumb("Ajouter un personnage") ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Ajouter un personnage') ?>

<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('id', array('label' => 'Nom', 'options' => $characters)) ?>
<?php echo $this->Form->end('Ajouter') ?>
