<?php $this->Html->addCrumb($user['User']['username']) ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', $user['User']['username']) ?>
<?php $this->assign('header.description', $user['Group']['name']) ?>

<?php if (!empty($user['User']['presentation'])): ?>
<div class="section">
<h3>Présentation</h3>
<?php echo $this->BBCode->parse($user['User']['presentation']) ?>
</div>
<?php endif ?>

<?php if (!empty($user['Character'])): ?>
<div class="section">
<h3>Ses personnages</h3>
<ul class="link-list">
<?php foreach($user['Character'] as $character): ?>
<li class="span-3">
<?php echo $this->Html->link($character['name'], sprintf('http://eu.battle.net/wow/fr/character/%s/%s/', $character['Realm']['slug'], $character['name']), array('class' => "color-c{$character['class']}")) ?>
</li>
<?php endforeach ?>
</ul>
</div>
<?php endif ?>
<?php if (AclComponent::hasRole('moderate_users')): ?>
<div class="section-action">
<?php echo $this->Html->link('Editer', array('action' => 'edit', $user['User']['id']), array('class' => 'ui-button')) ?>
</div>
<?php endif ?>
