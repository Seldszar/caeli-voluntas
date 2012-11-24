<?php $this->Html->addCrumb($user['User']['username']) ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', $user['User']['username'] . " <em>{$user['Group']['name']}</em>") ?>
<?php $this->assign('content.class', 'no-padding') ?>

<?php if (AclComponent::hasRole('moderate_users')) : ?>
<?php $this->assign('header.description', $this->Html->link('Modérer le compte', array('action' => 'edit', $user['User']['id']), array('class' => 'ui-button'))) ?>
<?php endif ?>

<div class="user-section">
<h2>Présentation</h2>
<?php if (!empty($user['User']['presentation'])) : ?>
<div class="user-section-content">
<blockquote>
<?php echo $this->MarkitUp->parse($user['User']['presentation']) ?>
</blockquote>
</div>
<?php endif ?>
</div>

<div class="user-section">
<h2>Signature</h2>
<?php if (!empty($user['User']['signature'])) : ?>
<div class="user-section-content">
<blockquote>
<?php echo $this->MarkitUp->parse($user['User']['signature']) ?>
</blockquote>
</div>
<?php endif ?>
</div>

<?php if (!empty($user['Character'])) : ?>
<div class="user-section">
<h2>Ses personnages</h2>
<div class="user-section-content">
<div id="user-characters">
<?php foreach($user['Character'] as $character): ?>
<?php echo $this->Html->link($this->Html->image($character['avatar_url']), $character['armory_url'], array('title' => $character['name'], 'class' => 'user-character', 'escape' => false)) ?>
<?php endforeach ?>
</div>
</div>
</div>
<?php endif ?>

<?php if (AclComponent::hasRole('moderate_users')) : ?>
<div class="user-section">
<h2>Informations de modération</h2>
<div class="user-section-content">
<ul class="ui-custom-list">
<li>
<ul class="float-left">
<li>Date d'inscription :</li>
</ul>
<ul class="float-right">
<li><?php echo $this->Time->timeAgoInWords($user['User']['created']) ?></li>
</ul>
</li>
<li>
<ul class="float-left">
<li>Adresse e-mail actuelle :</li>
</ul>
<ul class="float-right">
<li><?php echo $user['User']['email'] ?></li>
</ul>
</li>
<li>
<ul class="float-left">
<li>Etat du compte :</li>
</ul>
<ul class="float-right">
<li><?php echo $user['User']['active'] ? 'Confirmé' : 'Non confirmé' ?></li>
</ul>
</li>
<li>
<ul class="float-left">
<li>Dernière connexion :</li>
</ul>
<ul class="float-right">
<li><?php echo !empty($user['User']['last_login']) ? $this->Time->timeAgoInWords($user['User']['last_login']) : 'Indisponible' ?></li>
</ul>
</li>
<li>
<ul class="float-left">
<li>Dernière IP connue :</li>
</ul>
<ul class="float-right">
<li><?php echo !empty($user['User']['last_ip']) ? $user['User']['last_ip'] : 'Indisponible' ?></li>
</ul>
</li>
</ul>
</div>
</div>
<?php endif ?>
