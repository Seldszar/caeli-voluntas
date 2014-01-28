<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Groupes d'utilisateurs", array('action' => 'index')) ?>
<?php $this->Html->addCrumb("Editer un groupe d'utilisateur") ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', "Editer un groupe d'utilisateur") ?>

<?= $this->Form->create() ?>
<div class="section">
<h3>Informations sur le groupe d'utilisateur</h3>
<?= $this->Form->input('name', array('label' => 'Nom')) ?>
<?= $this->Form->input('position', array('label' => 'Position')) ?>
</div>
<?php if (!empty($roles)) : ?>
<div class="section">
<h3>Permissions du groupe d'utilisateur</h3>
<?= $this->Form->input('Role', array('label' => false, 'multiple' => 'checkbox')) ?>
</div>
<?php endif ?>
<?= $this->Form->end('Editer') ?>
