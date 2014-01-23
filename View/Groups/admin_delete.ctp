<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Groupes d'utilisateurs", array('action' => 'index')) ?>
<?php $this->Html->addCrumb("Supprimer un groupe d'utilisateur") ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', "Supprimer un groupe d'utilisateur") ?>

<?= $this->Form->create() ?>
<p>Plusieurs utilisateurs font partie de ce groupe.</p>
<p>Vous devez sélectionner un nouveau groupe dans lequel ils seront déplacés.</p>
<?= $this->Form->input('id', array('label' => "Nouveau groupe d'utilisateur", 'options' => $groups)) ?>
<?= $this->Form->end('Supprimer') ?>
