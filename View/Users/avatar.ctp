<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users', 'action' => 'index')) ?>
<?php $this->Html->addCrumb('Mon avatar') ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', 'Mon avatar') ?>
<?php //$this->assign('header.description', $this->Html->link('Editer mes informations personnelles', array('action' => 'edit'), array('class' => 'ui-button'))) ?>
<?php //$this->assign('content.class', 'no-padding') ?>

<?php echo $this->Form->create(array('id' => 'user-avatar-form', 'type' => 'file')) ?>
<table id="user-avatar-placeholder">
<tr>
<td>
<?php echo $this->Html->image($user['User']['avatar_url'], array('id' => 'user-avatar-image')) ?>
<div id="user-avatar-caption">Cliquez ici pour changer l'avatar</div>
<?php echo $this->Form->file('avatar', array('id' => 'user-avatar-file')) ?>
</td>
</tr>
</table>
<?php echo $this->Form->end() ?>

<?php echo $this->Form->create(array('id' => 'user-avatar-delete', 'type' => 'delete')) ?>
<?php echo $this->Form->button("Supprimer") ?>
<?php echo $this->Form->end() ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#user-avatar-file').change(function() {
		$('#user-avatar-placeholder').addClass('in-progress');
		$('#user-avatar-caption').text('Téléchargement en cours...');
		$('#user-avatar-form').submit();
	});
});
<?php $this->end() ?>
