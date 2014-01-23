<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', $this->Auth->user('username') . " <em>{$user['Group']['name']}</em>") ?>
<?php $this->assign('header.description', $this->Html->link('Editer mes informations personnelles', array('action' => 'edit'), array('class' => 'ui-button'))) ?>
<?php $this->assign('content.class', 'no-padding') ?>

<div class="profile-section">
<h2>Présentation<?= empty($user['User']['presentation']) ? " <em>(Vous n'avez actuellement aucune présentation)</em>" : null ?></h2>
<?php if (!empty($user['User']['presentation'])): ?>
<div class="profile-section-content">
<blockquote>
<?= $this->Parser->parseAsString($user['User']['presentation'], 'bbcode') ?>
</blockquote>
</div>
<?php endif ?>
</div>
<div class="profile-section">
<h2>Signature<?= empty($user['User']['signature']) ? " <em>(Vous n'avez actuellement aucune signature)</em>" : null ?></h2>
<?php if (!empty($user['User']['signature'])): ?>
<div class="profile-section-content">
<blockquote>
<?= $this->Parser->parseAsString($user['User']['signature'], 'bbcode') ?>
</blockquote>
</div>
<?php endif ?>
</div>
