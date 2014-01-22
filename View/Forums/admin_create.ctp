<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Forums', array('action' => 'index')) ?>
<?php $this->Html->addCrumb($category['ForumCategory']['name'], array('controller' => 'forumCategories', 'action' => 'view', $category['ForumCategory']['id'])) ?>
<?php $this->Html->addCrumb('Ajouter un forum') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Ajouter un forum') ?>

<div class="section">
<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('name', array('label' => 'Nom')) ?>
<?php echo $this->Form->input('description', array('label' => 'Description')) ?>
<div class="section-action">
<?php echo $this->Form->end('Sauver') ?>
</div>
</div>
