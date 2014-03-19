<h3><?= $zone['EncounterZone']['name'] ?> <em>(<?= $zone['EncounterZone']['heroic_mode']  ? $zone['EncounterZone']['heroic_progress'] : $zone['EncounterZone']['normal_progress'] ?>/<?= $zone['EncounterZone']['num_bosses'] ?> <?= $zone['EncounterZone']['heroic_mode'] ? 'héroïque' : 'normal' ?>)</em></h3>
<ul>
<?php foreach ($zone['Encounter'] as $encounter): ?>
<li class="<?= $encounter['normal'] ? null : 'inactive' ?>"><?= $encounter['name'] ?><?= $encounter['heroic'] ? ' <em>(héroïque)</em>' : null ?></li>
<?php endforeach ?>
</ul>