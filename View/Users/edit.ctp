<?php $this->Html->addCrumb($user['User']['username'], array('controller' => 'users', 'action' => 'view', $user['User']['id'], 'admin' => false)) ?>
<?php $this->Html->addCrumb('Editer le compte') ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', 'Editer le compte') ?>
<?php $this->assign('content.class', 'no-padding') ?>

<?= $this->Form->create(null, array('type' => 'put')) ?>
<div class="profile-section">
<h2>Présentation</h2>
<div class="profile-section-content">
<?= $this->Form->input('presentation', array('label' => false, 'rows' => 4)) ?>
</div>
</div>
<div class="profile-section">
<h2>Signature</h2>
<div class="profile-section-content">
<?= $this->Form->input('signature', array('label' => false, 'rows' => 4)) ?>
</div>
</div>
<?php if (AclComponent::hasRole('moderate_users') && $this->data['User']['group'] != 2) : ?>
<div class="profile-section">
<h2>Groupe d'utilisateur</h2>
<div class="profile-section-content">
<?= $this->Form->input('group', array('label' => false, 'options' => $groups)) ?>
</div>
</div>
<?php endif ?>
<?= $this->Form->end(array('label' => 'Sauver les modifications', 'div' => array('class' => 'profile-bottom'))) ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#UserPresentation, #UserSignature').markItUp(mySettings);
});
<?php $this->end() ?>
