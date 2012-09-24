<?php $this->Html->addCrumb("Roster de la guilde") ?>

<?php $this->assign('header.image', 'roster') ?>
<?php $this->assign('header.title', 'Roster de la guilde') ?>

<?php foreach ($roster as $class): ?>
<?php if (!empty($class['Character'])): ?>
<div class="section">
<h3><?php echo $class['CharacterClass']['name'] ?></h3>
<ul class="link-list">
<?php foreach ($class['Character'] as $character) : ?>
<li class="span-3 color-c<?php echo $class['CharacterClass']['id'] ?>"><?php echo $character['name'] ?></li>
<?php endforeach ?>
</ul>
</div>
<?php endif ?>
<?php endforeach ?>
