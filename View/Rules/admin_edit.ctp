<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Charte de bonne conduite', array('action' => 'index')) ?>
<?php $this->Html->addCrumb('Editer') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Editer la charte de bonne conduite') ?>

<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('content', array('label' => false, 'placeholder' => "Saisissez le contenu de la charte", 'rows' => 22)) ?>
<?php echo $this->Form->end('Sauver') ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#PageContent').markItUp(mySettings);
});
<?php $this->end() ?>