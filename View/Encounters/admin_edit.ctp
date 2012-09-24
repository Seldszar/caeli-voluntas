<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Avancée raids', array('controller' => 'encounterZones', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($encounter['EncounterZone']['name'], array('controller' => 'encounterZones', 'action' => 'view', $encounter['EncounterZone']['id'])) ?>
<?php $this->Html->addCrumb('Editer un boss') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Editer un boss') ?>

<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('name', array('label' => 'Nom')) ?>
<?php echo $this->Form->end(array('label' => 'Sauver', 'after' => $this->Html->link('Supprimer', array('action' => 'delete', $encounter['Encounter']['id']), null, 'Voulez-vous vraiment supprimer ce boss ?'))) ?>
