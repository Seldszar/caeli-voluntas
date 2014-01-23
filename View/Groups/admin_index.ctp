<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Groupes d'utilisateurs") ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', "Groupes d'utilisateurs") ?>

<?php if (!empty($groups)) : ?>
<ul class="ui-custom-list">
<?php foreach ($groups as $group): ?>
<li>
<ul class="float-left">
<li><?php echo $this->Html->link($group['Group']['name'], array('action' => 'edit', $group['Group']['id'])) ?></li>
</ul>
<?php if ($group['Group']['allow_delete']) : ?>
<ul class="float-right ui-button-set on-hover">
<li><?php echo $this->Html->link('Supprimer', array('action' => 'delete', $group['Group']['id']), null, "Voulez-vous vraiment supprimer ce groupe d'utilisateur ?") ?></li>
</ul>
<?php endif ?>
</li>
<?php endforeach ?>
</ul>
<?php else : ?>
<p>Il n'y a actuellement aucun groupe d'utilisateur</p>
<?php endif ?>
<div class="section-action">
<?= $this->Html->link("Ajouter un groupe d'utilisateur", array('action' => 'create'), array('class' => 'ui-button')) ?>
</div>
