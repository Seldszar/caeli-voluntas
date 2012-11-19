<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Editer le compte') ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', 'Editer le compte') ?>

<?php echo $this->Form->create() ?>
<div class="section">
<h3>Modifier la présentation</h3>
<?php echo $this->Form->input('presentation', array('label' => false, 'rows' => 10)) ?>
</div>
<?php if (AclComponent::hasRole('moderate_users') && $this->data['User']['group'] != 2) : ?>
<div class="section">
<h3>Modifier le groupe d'utilisateur</h3>
<?php echo $this->Form->input('group', array('label' => false, 'options' => $groups)) ?>
</div>
<?php endif ?>
<?php echo $this->Form->end('Sauver') ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#UserPresentation').markItUp(mySettings);
});
<?php $this->end() ?>
