<?php $this->extend('/Layouts/two_column_base') ?>

<?php $this->assign('body.id', 'user') ?>

<?php $this->start('left') ?>
<div class="menu-section">
<h2>Menu principal</h2>
<ul>
<li><?php echo $this->Html->link("Mon compte", array('controller' => 'users', 'action' => 'index', 'admin' => false), array('current' => true)) ?></li>
<li><?php echo $this->Html->link("Mon avatar", array('controller' => 'users', 'action' => 'avatar', 'admin' => false), array('current' => true)) ?></li>
<li><?php echo $this->Html->link("Mes personnages", array('controller' => 'characters', 'action' => 'index', 'admin' => false), array('current' => true)) ?></li>
<li><?php echo $this->Html->link("Changer d'adresse e-mail", array('controller' => 'users', 'action' => 'email', 'admin' => false), array('current' => true)) ?></li>
<li><?php echo $this->Html->link("Changer le mot de passe", array('controller' => 'users', 'action' => 'password', 'admin' => false), array('current' => true)) ?></li>
</ul>
</div>
<?php if (AclComponent::hasAnyRole(array('manage_blog', 'manage_forums', 'manage_roster', 'manage_gallery', 'edit_rules', 'manage_recruitment', 'manage_encounters', 'manage_groups', 'moderate_users'))): ?>
<div class="menu-section">
<h2>Administration</h2>
<ul>
<?php if (AclComponent::hasRole('manage_blog')): ?>
<li><?php echo $this->Html->link("Blog", array('controller' => 'blog', 'action' => 'index', 'admin' => true)) ?></li>
<?php endif ?>
<?php if (AclComponent::hasRole('manage_forums')): ?>
<li><?php echo $this->Html->link("Forums", array('controller' => 'forumCategories', 'action' => 'index', 'admin' => true)) ?></li>
<?php endif ?>
<?php if (AclComponent::hasRole('manage_roster')): ?>
<li><?php echo $this->Html->link("Roster de la guilde", array('controller' => 'roster', 'action' => 'index', 'admin' => true)) ?></li>
<?php endif ?>
<?php if (AclComponent::hasRole('manage_gallery')): ?>
<li><?php echo $this->Html->link("Galerie", array('controller' => 'gallery', 'action' => 'index', 'admin' => true)) ?></li>
<?php endif ?>
<?php if (AclComponent::hasRole('edit_rules')): ?>
<li><?php echo $this->Html->link("Charte de bonne conduite", array('controller' => 'rules', 'action' => 'index', 'admin' => true)) ?></li>
<?php endif ?>
<?php if (AclComponent::hasRole('manage_recruitment')): ?>
<li><?php echo $this->Html->link("Etat du recrutement", array('controller' => 'recruitment', 'action' => 'index', 'admin' => true)) ?></li>
<?php endif ?>
<?php if (AclComponent::hasRole('manage_encounters')): ?>
<li><?php echo $this->Html->link("Avancée raids", array('controller' => 'encounterZones', 'action' => 'index', 'admin' => true)) ?></li>
<?php endif ?>
<?php if (AclComponent::hasRole('manage_groups')): ?>
<li><?php echo $this->Html->link("Groupes d'utilisateurs", array('controller' => 'groups', 'action' => 'index', 'admin' => true)) ?></li>
<?php endif ?>
<?php if (AclComponent::hasRole('moderate_users')): ?>
<li><?php echo $this->Html->link("Utilisateurs", array('controller' => 'users', 'action' => 'index', 'admin' => true)) ?></li>
<?php endif ?>
</ul>
</div>
<?php endif ?>
<?php $this->end() ?>

<?php $this->start('right') ?>
<?php if ($this->fetch('page-header')): ?>
<?php echo $this->fetch('page-header') ?>
<?php else: ?>
<div id="page-header"<?php if ($this->fetch('header.image')) : ?> style="background-image: url('<?php echo $this->Html->url('/img/headers/right-' . $this->fetch('header.image') . '.jpg') ?>')"<?php endif ?>>
<h1><?php echo $this->fetch('header.title') ?></h1>
<?php if ($this->fetch('header.description')): ?>
<div class="description"><?php echo $this->fetch('header.description') ?></div>
<?php endif ?>
</div>
<?php endif ?>
<div id="page-content" class="<?php echo $this->fetch('content.class') ?>">
<?php echo $this->fetch('content') ?>
</div>
<?php $this->end() ?>
