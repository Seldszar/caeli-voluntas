<?php $zones = $this->requestAction(array('controller' => 'encounterZones', 'action' => 'sidebarData')) ?>
<div class="sidebar-module">
<h2>Avancée raids</h2>
<div class="sidebar-module-content">
<?php foreach ($zones as $zone) : ?>
<div class="encounter-zone">
<div class="zone-name"><?php echo $zone['EncounterZone']['name'] ?></div>
<div class="zone-progress" title="<?php echo htmlspecialchars($this->requestAction(array('controller' => 'encounterZones', 'action' => 'tooltip', $zone['EncounterZone']['id']), array('return'))) ?>">
<div class="normal-mode" style="width: <?= $zone['EncounterZone']['normal_progress_percentage'] ?>%"></div>
<div class="heroic-mode" style="width: <?= $zone['EncounterZone']['heroic_progress_percentage'] ?>%"></div>
</div>
</div>
<?php endforeach ?>
</div>
</div>
