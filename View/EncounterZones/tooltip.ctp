<h3><?php echo $zone['EncounterZone']['name'] ?> <em>(<?php echo $zone['EncounterZone']['heroic_mode']  ? $zone['EncounterZone']['heroic_progress'] : $zone['EncounterZone']['normal_progress'] ?>/<?php echo $zone['EncounterZone']['num_bosses'] ?> <?php echo $zone['EncounterZone']['heroic_mode'] ? 'héroïque' : 'normal' ?>)</em></h3>
<ul>
<?php foreach ($zone['Encounter'] as $encounter): ?>
<li class="<?php echo $encounter['normal'] ? null : 'inactive' ?>"><?php echo $encounter['name'] ?><?php echo $encounter['heroic'] ? ' <em>(héroïque)</em>' : null ?></li>
<?php endforeach ?>
</ul>