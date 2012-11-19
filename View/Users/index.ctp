<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', AuthComponent::user('username') . " <em>{$user['Group']['name']}</em>") ?>
<?php $this->assign('header.description', $this->Html->link('Editer mes informations personnelles', array('action' => 'edit'), array('class' => 'ui-button'))) ?>
<?php $this->assign('content.class', 'no-padding') ?>

<div class="profile-section">
<h2>Présentation<?php echo empty($user['User']['presentation']) ? " <em>(Vous n'avez actuellement aucune présentation)</em>" : null ?></h2>
<?php if (!empty($user['User']['presentation'])): ?>
<div class="profile-section-content">
<?php echo $this->MarkitUp->parse($user['User']['presentation']) ?>
</div>
<?php endif ?>
</div>
<div class="profile-section">
<h2>Signature<?php echo empty($user['User']['signature']) ? " <em>(Vous n'avez actuellement aucune signature)</em>" : null ?></h2>
<?php if (!empty($user['User']['signature'])): ?>
<div class="profile-section-content">
<?php echo $this->MarkitUp->parse($user['User']['signature']) ?>
</div>
<?php endif ?>
</div>
