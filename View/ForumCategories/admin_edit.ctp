<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Forums', array('action' => 'index')) ?>
<?php $this->Html->addCrumb('Editer une catégorie') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Editer une catégorie') ?>

<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('name', array('label' => 'Nom')) ?>
<?php echo $this->Form->end('Sauver') ?>
