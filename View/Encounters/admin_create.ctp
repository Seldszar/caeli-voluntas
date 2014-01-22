<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Avancée raids', array('controller' => 'encounterZones', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($zone['EncounterZone']['name'], array('controller' => 'encounterZones', 'action' => 'view', $zone['EncounterZone']['id'])) ?>
<?php $this->Html->addCrumb('Ajouter un boss') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Ajouter un boss') ?>

<?= $this->Form->create() ?>
<?= $this->Form->input('name', array('label' => 'Nom')) ?>
<?= $this->Form->end('Sauver') ?>
