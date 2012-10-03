<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb("Utilisateurs") ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', "Utilisateurs") ?>

<?php if (!empty($users)) : ?>
<ul class="ui-custom-list">
<?php foreach ($users as $user): ?>
<li>
<ul class="float-left">
<li class="<?php echo $user['User']['active'] ? null : 'inactive' ?>"><?php echo $this->Html->link($user['User']['username'], array('action' => 'view', $user['User']['id'], 'admin' => false)) ?></li>
</ul>
<ul class="float-right">
<li class="link-desc"><?php echo $user['Group']['name'] ?></li>
<li class="link-desc">Inscrit le <?php echo $this->Time->format($user['User']['created']) ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
<?php else : ?>
<p>Il n'y a actuellement aucun groupe d'utilisateur</p>
<?php endif ?>
