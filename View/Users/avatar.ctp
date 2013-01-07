<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users', 'action' => 'index')) ?>
<?php $this->Html->addCrumb('Mon avatar') ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', 'Mon avatar') ?>

<?php echo $this->Form->create(array('id' => 'user-avatar-form', 'type' => 'file')) ?>
<div id="user-avatar-placeholder">
<table>
<tr>
<td>
<?php echo $this->Html->image($user['User']['avatar_url'], array('id' => 'user-avatar-image')) ?>
<div id="user-avatar-caption">Cliquez ici pour changer l'avatar</div>
<?php echo $this->Form->file('avatar', array('id' => 'user-avatar-file')) ?>
<?php echo $this->Form->button(null, array('id' => 'user-avatar-button')) ?>
</td>
</tr>
</table>
</div>
<?php echo $this->Form->end() ?>

<?php if (!empty($user['User']['avatar'])) : ?>
<?php echo $this->Form->create(array('id' => 'user-avatar-delete', 'type' => 'delete')) ?>
<?php echo $this->Form->button("Supprimer") ?>
<?php echo $this->Form->end() ?>
<?php endif ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#user-avatar-button').click(function(e) {
		$('#user-avatar-file').change(function() {
			$('#user-avatar-placeholder').addClass('in-progress');
			$('#user-avatar-caption').text('Téléchargement en cours...');
			$('#user-avatar-form').submit();
		}).click();
		e.preventDefault();
	});
});
<?php $this->end() ?>
