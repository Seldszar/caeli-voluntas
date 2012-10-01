<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Personnages', array('action' => 'index')) ?>
<?php $this->Html->addCrumb('Ajouter un personnage') ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', 'Ajouter un personnage') ?>

<?php echo $this->Session->flash() ?>
<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('name', array('label' => 'Nom')) ?>
<?php echo $this->Form->input('realm', array('label' => 'Royaume', 'type' => 'select', 'options' => $realms, 'empty' => 'Sélectionnez...')) ?>
<?php echo $this->Form->input('class', array('label' => 'Classe', 'type' => 'select', 'options' => $classes, 'empty' => 'Sélectionnez...')) ?>
<?php echo $this->Form->end('Ajouter') ?>
