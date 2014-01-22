<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Blog', array('action' => 'index')) ?>
<?php $this->Html->addCrumb('Editer un article') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Editer un article') ?>

<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('title', array('label' => false, 'placeholder' => 'Saisissez le titre')) ?>
<?php echo $this->Form->input('content', array('label' => false, 'placeholder' => 'Saisissez le contenu')) ?>
<?php echo $this->Form->end(array('label' => 'Sauver', 'after' => $this->Html->link('Supprimer', array('action' => 'delete', $article['BlogArticle']['id']), null, 'Voulez-vous vraiment supprimer cet article ?'))) ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#BlogArticleContent').markItUp(mySettings);
});
<?php $this->end() ?>