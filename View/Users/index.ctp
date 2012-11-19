<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', AuthComponent::user('username')) ?>
<?php $this->assign('header.description', $user['Group']['name']) ?>

<div class="section">
<h3>Présentation</h3>
<?php if (!empty($user['User']['presentation'])): ?>
<?php echo $this->MarkitUp->parse($user['User']['presentation']) ?>
<?php else: ?>
Vous n'avez pas saisi de présentation
<?php endif ?>
</div>
<?php echo $this->Html->link('Editer mon compte', array('action' => 'edit'), array('class' => 'ui-button')) ?>
