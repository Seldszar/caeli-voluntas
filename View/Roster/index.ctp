<?php $this->Html->addCrumb("Roster de la guilde") ?>

<?php $this->assign('header.image', 'roster') ?>
<?php $this->assign('header.title', 'Roster de la guilde') ?>
<?php $this->assign('content.class', 'no-padding') ?>

<div id="roster">
<?php foreach ($roster as $k => $class): ?>
<?php if (!empty($class['Character'])): ?>
<div class="roster-class">
<h2 class="color-c<?= $class['CharacterClass']['id'] ?>"><?php echo $class['CharacterClass']['name'] ?></h2>
<div class="roster-characters">
<?php foreach ($class['Character'] as $k => $character) : ?>
<?= $this->Html->link($this->Html->image($character['User']['avatar_url'], array('title' => $character['name'])), array('controller' => 'users', 'action' => 'view', $character['user']), array('escape' => false, 'class' => array('roster-character', ($k < 2 ? 'first' : null)))) ?>
<?php endforeach ?>
</div>
</div>
<?php endif ?>
<?php endforeach ?>
</div>
