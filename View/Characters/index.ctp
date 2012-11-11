<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Mes personnages') ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', 'Mes personnages') ?>

<?php if (!empty($realms)) : ?>
<?php foreach ($realms as $realm) : ?>
<?php if (!empty($realm['Character'])) : ?>
<div class="section">
<h3><?php echo $realm['Realm']['name'] ?></h3>
<ul class="ui-custom-list">
<?php foreach ($realm['Character'] as $character) : ?>
<li>
<ul class="float-left">
<li class="color-c<?php echo $character['class'] ?>"><?php echo $character['name'] ?></li>
</ul>
<ul class="float-right ui-button-set on-hover">
<li><?php echo $this->Html->link("Supprimer", array('action' => 'delete', $character['id']), null, "Voulez-vous vraiment supprimer {$character['name']} ?") ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
</div>
<?php endif ?>
<?php endforeach ?>
<?php else : ?>
<h2 class="caption-empty">Vous n'avez actuellement aucun personnage</h2>
<?php endif ?>
<div class="section-action">
<?php echo $this->Html->link('Ajouter un personnage', array('action' => 'create'), array('class' => 'ui-button')) ?>
</div>
