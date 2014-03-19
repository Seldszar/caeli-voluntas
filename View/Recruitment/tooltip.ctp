<h3><?= $class['CharacterClass']['name'] ?></h3>
<ul>
<?php foreach($class['CharacterSpec'] as $spec): ?>
<li class="<?= $spec['recruitment_active'] ? null : 'inactive' ?>"><?= $spec['name'] ?></li>
<?php endforeach ?>
</ul>
