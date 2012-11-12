<?php $classes = $this->requestAction(array('controller' => 'recruitment', 'action' => 'sidebarData')) ?>
<div class="sidebar-module">
<h2>Etat du recrutement</h2>
<div class="sidebar-module-content">
<?php foreach ($classes as $class) : ?>
<div class="recruitment-class color-c<?php echo $class['CharacterClass']['id'] ?> <?php echo !empty($class['CharacterSpec']) ? "active" : "inactive" ?>"><span title="<?php echo htmlspecialchars($this->requestAction(array('controller' => 'recruitment', 'action' => 'tooltip', $class['CharacterClass']['id']), array('return'))) ?>"><?php echo $class['CharacterClass']['name'] ?></span></div>
<?php endforeach ?>
<div class="clear"></div>
</div>
</div>
