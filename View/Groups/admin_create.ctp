<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Roster de la guilde", array('action' => 'index')) ?>
<?php $this->Html->addCrumb("Ajouter un groupe d'utilisateur") ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', "Ajouter un groupe d'utilisateur") ?>

<?php echo $this->Form->create() ?>
<div class="section">
<h3>Informations sur le groupe d'utilisateur</h3>
<?php echo $this->Form->input('name', array('label' => 'Nom')) ?>
<?php echo $this->Form->input('color', array('label' => 'Couleur')) ?>
</div>
<?php if (!empty($roles)) : ?>
<div class="section">
<h3>Permissions du groupe d'utilisateur</h3>
<?php echo $this->Form->input('Role', array('multiple' => 'checkbox')) ?>
</div>
<?php endif ?>
<?php echo $this->Form->end('Ajouter') ?>
