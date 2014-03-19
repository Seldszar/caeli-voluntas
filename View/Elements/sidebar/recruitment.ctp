<?php $classes = $this->requestAction(array('controller' => 'recruitment', 'action' => 'sidebarData')) ?>
<div class="sidebar-module">
<h2>Etat du recrutement</h2>
<div class="sidebar-module-content">
<?php foreach ($classes as $class) : ?>
<div class="recruitment-class color-c<?= $class['CharacterClass']['id'] ?> <?= !empty($class['CharacterSpec']) ? "active" : "inactive" ?>"><span title="<?= htmlspecialchars($this->requestAction(array('controller' => 'recruitment', 'action' => 'tooltip', $class['CharacterClass']['id']), array('return'))) ?>"><?= $class['CharacterClass']['name'] ?></span></div>
<?php endforeach ?>
<div class="clear"></div>
</div>
</div>
