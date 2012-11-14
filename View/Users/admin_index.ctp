<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Utilisateurs") ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', "Utilisateurs") ?>

<?php if (!empty($groups)) : ?>
<?php foreach ($groups as $group): ?>
<div class="section">
<h3><?php echo $group['Group']['name'] ?> <em><?php echo count($group['User']) ?> membre(s)</em></h3>
<ul class="ui-custom-list">
<?php foreach ($group['User'] as $user): ?>
<li>
<ul class="float-left">
<li><?php echo $this->Html->link($user['username'], array('action' => 'view', $user['id'], 'admin' => false), array('title' => $this->requestAction(array('action' => 'tooltip', $user['id']), array('return')))) ?></li>
</ul>
<ul class="float-right link-desc">
<?php if (!$user['active']): ?>
<li>En attente de confirmation</li>
<?php endif ?>
</ul>
</li>
<?php endforeach ?>
</ul>
</div>
<?php endforeach ?>
<?php else : ?>
<p>Il n'y a actuellement aucun groupe d'utilisateur</p>
<?php endif ?>
