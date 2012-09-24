<h3><?php echo $class['CharacterClass']['name'] ?></h3>
<ul>
<?php foreach($class['CharacterSpec'] as $spec): ?>
<li class="<?php echo $spec['recruitment_active'] ? null : 'inactive' ?>"><?php echo $spec['name'] ?></li>
<?php endforeach ?>
</ul>
