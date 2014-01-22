<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Roster de la guilde", array('action' => 'index')) ?>
<?php $this->Html->addCrumb("Ajouter un groupe d'utilisateur") ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', "Ajouter un groupe d'utilisateur") ?>

<?= $this->Form->create() ?>
<div class="section">
<h3>Informations sur le groupe d'utilisateur</h3>
<?= $this->Form->input('name', array('label' => 'Nom')) ?>
<?= $this->Form->input('color', array('label' => 'Couleur')) ?>
</div>
<?php if (!empty($roles)) : ?>
<div class="section">
<h3>Permissions du groupe d'utilisateur</h3>
<?= $this->Form->input('Role', array('label' => false, 'multiple' => 'checkbox')) ?>
</div>
<?php endif ?>
<?= $this->Form->end('Ajouter') ?>
