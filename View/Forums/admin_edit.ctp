<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Forums', array('controller' => 'forumCategories', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($forum['ForumCategory']['name'], array('controller' => 'forumCategories', 'action' => 'view', $forum['ForumCategory']['id'])) ?>
<?php $this->Html->addCrumb('Editer un forum') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Editer un forum') ?>

<div class="section">
<?= $this->Form->create() ?>
<h3>Modifier les informations sur le forum</h3>
<?= $this->Form->input('name', array('label' => 'Nom')) ?>
<?= $this->Form->input('description', array('label' => 'Description')) ?>
<?= $this->Form->input('category', array('label' => 'Catégorie', 'options' => $categories)) ?>
</div>
<div class="section">
<h3>Modifier les permissions des groupes pour ce forum</h3>
<table>
<thead>
<tr>
<td></td>
<td class="center" width="16%">Lire le forum</td>
<td class="center" width="16%">Répondre aux messages</td>
<td class="center" width="16%">Créer des discussions</td>
<td class="center" width="16%">Modérer le forum</td>
</tr>
</thead>
<tbody>
<?php foreach ($groups as $k => $group): ?>
<tr>
<td><?php echo $this->Form->hidden("ForumAccess.{$k}.group", array('value' => $group['Group']['id'])) ?><?php echo $group['Group']['name'] ?></td>
<td class="center"><?php echo $this->Form->checkbox("ForumAccess.{$k}.view") ?></td>
<td class="center"><?php echo ($group['Group']['id'] != 1 ? $this->Form->checkbox("ForumAccess.{$k}.reply") : null) ?></td>
<td class="center"><?php echo ($group['Group']['id'] != 1 ? $this->Form->checkbox("ForumAccess.{$k}.create") : null) ?></td>
<td class="center"><?php echo ($group['Group']['id'] != 1 ? $this->Form->checkbox("ForumAccess.{$k}.moderate") : null) ?></td>
</tr>
<?php endforeach ?>
</tbody>
</table>
<?= $this->Form->end('Sauver') ?>
</div>
