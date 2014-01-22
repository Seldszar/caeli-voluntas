<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Blog', array('action' => 'index')) ?>
<?php $this->Html->addCrumb('Ajouter un article') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Ajouter un article') ?>

<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('title', array('label' => false, 'placeholder' => 'Saisissez le titre')) ?>
<?php echo $this->Form->input('content', array('label' => false, 'placeholder' => 'Saisissez le contenu')) ?>
<?php echo $this->Form->end('Sauver') ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#BlogArticleContent').markItUp(mySettings);
});
<?php $this->end() ?>