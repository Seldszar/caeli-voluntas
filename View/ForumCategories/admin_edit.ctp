<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Forums', array('action' => 'index')) ?>
<?php $this->Html->addCrumb('Editer une catégorie') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Editer une catégorie') ?>

<?= $this->Form->create() ?>
<?= $this->Form->input('name', array('label' => 'Nom')) ?>
<?= $this->Form->end('Sauver') ?>
