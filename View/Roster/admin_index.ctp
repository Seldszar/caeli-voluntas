<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Roster de la guilde") ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Roster de la guilde') ?>

<?php if (!empty($roster)) : ?>
<ul class="ui-custom-list">
<?php foreach ($roster as $character): ?>
<li>
<ul class="float-left">
<li><a href="#" class="color-c<?php echo $character['Character']['class'] ?>"><?php echo $character['Character']['name'] ?></a></li>
</ul>
<ul class="float-right ui-button-set on-hover">
<li><?php echo $this->Html->link('Supprimer', array('action' => 'delete', $character['Character']['id']), null, "Voulez-vous vraiment supprimer de ce personnage du roster de la guilde ?") ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
<?php endif ?>
<div class="section-action">
<?php echo $this->Html->link('Ajouter un personnage', array('action' => 'create'), array('class' => 'ui-button')) ?>
</div>
