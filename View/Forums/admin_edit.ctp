<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Forums', array('controller' => 'forumCategories', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($forum['ForumCategory']['name'], array('controller' => 'forumCategories', 'action' => 'view', $forum['ForumCategory']['id'])) ?>
<?php $this->Html->addCrumb('Editer un forum') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Editer un forum') ?>

<div class="section">
<?php echo $this->Form->create() ?>
<h3>Modifier les informations sur le forum</h3>
<?php echo $this->Form->input('name', array('label' => 'Nom')) ?>
<?php echo $this->Form->input('description', array('label' => 'Description')) ?>
<?php echo $this->Form->input('category', array('label' => 'Catégorie', 'options' => $categories)) ?>
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
<?php foreach ($groups as $id => $name): ?>
<tr>
<td><?php echo $this->Form->hidden("ForumAccess.{$id}.group", array('value' => $id)) ?><?php echo $name ?></td>
<td class="center"><?php echo $this->Form->checkbox("ForumAccess.{$id}.view") ?></td>
<td class="center"><?php echo ($id != 1 ? $this->Form->checkbox("ForumAccess.{$id}.reply") : null) ?></td>
<td class="center"><?php echo ($id != 1 ? $this->Form->checkbox("ForumAccess.{$id}.create") : null) ?></td>
<td class="center"><?php echo ($id != 1 ? $this->Form->checkbox("ForumAccess.{$id}.moderate") : null) ?></td>
</tr>
<?php endforeach ?>
</tbody>
</table>
<?php echo $this->Form->end('Sauver') ?>
</div>
