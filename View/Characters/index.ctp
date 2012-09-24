<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Mes personnages') ?>

<?php $this->assign('header.image', 'user') ?>
<?php $this->assign('header.title', 'Mes personnages') ?>

<?php if (!empty($characters)) : ?>
<ul class="ui-custom-list">
<?php foreach ($characters as $character) : ?>
<li>
<ul class="float-left">
<li class="color-c<?php echo $character['Character']['class'] ?>"><?php echo $character['Character']['name'] ?></li>
<li><div class="link-desc"><?php echo $character['Realm']['name'] ?></div></li>
</ul>
<ul class="float-right on-hover">
<li><?php echo $this->Html->link("Supprimer", array('action' => 'delete', $character['Character']['id']), null, "Voulez-vous vraiment supprimer {$character['Character']['name']} ?") ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
<?php else : ?>
<h2 class="caption-empty">Vous n'avez actuellement aucun personnage</h2>
<?php endif ?>
<div class="section-action">
<?php echo $this->Html->link('Ajouter un personnage', array('action' => 'create'), array('class' => 'ui-button')) ?>
</div>
