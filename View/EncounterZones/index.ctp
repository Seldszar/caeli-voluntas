<div class="section">
<h1>Avancée raids</h1>
<div class="section-inner">
<table>
<?php foreach($zones as $zone): ?>
<tr>
<td>
<?php echo $this->Html->link($zone['EncounterZone']['name'], array('action' => 'edit', $zone['EncounterZone']['id'], 'admin' => true)) ?>
</td>
</tr>
<?php endforeach ?>
</table>
</div>
</div>
