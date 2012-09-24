<?php $zones = $this->requestAction(array('controller' => 'encounterZones', 'action' => 'sidebarData')) ?>
<div class="sidebar-module">
<h2>Avancée raids</h2>
<div class="sidebar-module-content">
<?php foreach ($zones as $zone) : ?>
<div class="encounter-zone">
<div class="zone-name"><?php echo $zone['EncounterZone']['name'] ?></div>
<div class="zone-progress" data-zone="<?php echo $zone['EncounterZone']['id'] ?>">
<div class="normal-mode" style="width: <?php echo $zone['EncounterZone']['normal_progress_percentage'] ?>%"></div>
<div class="heroic-mode" style="width: <?php echo $zone['EncounterZone']['heroic_progress_percentage'] ?>%"></div>
</div>
</div>
<?php endforeach ?>
</div>
</div>

<?php $this->start('scripts') ?>
$('.zone-progress').each(function() {
var $t = $(this);

$t.tooltip('<?php echo $this->Html->url(array('controller' => 'encounterZones', 'action' => 'tooltip')) ?>', {id: $t.data('zone')});

});
<?php $this->end() ?>