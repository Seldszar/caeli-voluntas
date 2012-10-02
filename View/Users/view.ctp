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
<ul class="ui-custom-list">
<?php foreach($user['Character'] as $character): ?>
<li class="span-2">
<?php echo $this->Html->link($character['name'], sprintf('http://eu.battle.net/wow/fr/character/%s/%s/', $character['Realm']['slug'], $character['name']), array('class' => "color-c{$character['class']}")) ?>
</li>
<?php endforeach ?>
</ul>
</div>
<?php endif ?>
<?php if (AclComponent::hasRole('moderate_users')): ?>
<div class="section">
<h3>Informations complémentaires <em>(visibles uniquement par les modérateurs)</em></h3>
<ul class="ui-custom-list">
<li>
<ul class="float-left">
<li>Dernière connexion :</li>
</ul>
<ul class="float-right">
<li><?php echo !empty($user['User']['last_login']) ? $this->Time->timeAgoInWords($user['User']['last_login']) : "Indisponible" ?></li>
</ul>
</li>
<li>
<ul class="float-left">
<li>Dernière IP connue :</li>
</ul>
<ul class="float-right">
<li><?php echo !empty($user['User']['last_ip']) ? $user['User']['last_ip'] : "Indisponible" ?></li>
</ul>
</li>
</ul>
</div>
<div class="section-action">
<?php echo $this->Html->link('Editer', array('action' => 'edit', $user['User']['id']), array('class' => 'ui-button')) ?>
</div>
<?php endif ?>
