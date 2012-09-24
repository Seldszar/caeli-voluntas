<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Évènements', array('controller' => 'events', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($event['Event']['name'], array('controller' => 'events', 'action' => 'view', $event['Event']['id'])) ?>
<?php $this->Html->addCrumb("Répondre") ?>

<?php $this->assign('header.image', 'event') ?>
<?php $this->assign('header.title', "Répondre") ?>

<?php echo $this->Form->create('EventParticipant') ?>
<?php echo $this->Form->input('character', array('label' => 'Personnage', 'options' => $characters)) ?>
<?php echo $this->Form->input('status', array('label' => 'Etat', 'options' => $statuses)) ?>
<?php echo $this->Form->input('message', array('label' => 'Message')) ?>
<?php echo $this->Form->end('Répondre') ?>
