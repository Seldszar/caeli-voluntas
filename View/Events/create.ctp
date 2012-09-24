<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Événements', array('action' => 'index')) ?>
<?php $this->Html->addCrumb('Ajouter un événement') ?>

<?php $this->assign('header.image', 'events') ?>
<?php $this->assign('header.title', 'Ajouter un événement') ?>

<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('name', array('label' => 'Nom')) ?>
<?php echo $this->Form->input('description', array('label' => 'Description')) ?>
<?php echo $this->Form->input('type', array('label' => 'Type', 'options' => $types)) ?>
<?php echo $this->Form->input('begin', array('div' => array('class' => 'input date'), 'label' => 'Date de début', 'separator' => false, 'dateFormat' => 'DMY', 'timeFormat' => null)) ?>
<?php echo $this->Form->input('begin', array('div' => array('class' => 'input time'), 'label' => 'Heure de début', 'separator' => false, 'dateFormat' => null, 'timeFormat' => 24)) ?>
<?php echo $this->Form->end('Ajouter') ?>
