<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Évènements', array('action' => 'index')) ?>
<?php $this->Html->addCrumb($event['Event']['name']) ?>

<?php $this->start('page-header') ?>
<div id="event-header" style="background-image: url('<?php echo $this->Html->url('/' . IMAGES_URL . 'events' . '/' . $event['EventType']['image']) ?>')">
<h1><?php echo $event['Event']['name'] ?><span id="event-type"> &#8226; <?php echo $event['EventType']['name'] ?></span></h1>
<h3><?php echo $this->Time->format('l d F Y, H:i', $event['Event']['begin']) ?></h3>
<?php if (!empty($event['Event']['description'])) : ?>
<div id="event-description">&laquo; <?php echo $event['Event']['description'] ?> &raquo;</div>
<?php endif ?>
<?php if (AclComponent::hasRole('join_event')): ?>
<div id="event-action">
<?php echo $this->Html->link("Répondre à l'événement", array('controller' => 'eventParticipants', 'action' => 'answer', $event['Event']['id']), array('class' => 'ui-button')) ?>
</div>
<?php endif ?>
</div>
<?php $this->end() ?>

<?php foreach ($statuses as $status) : ?>
<div class="section">
<h3><?php echo $status['EventStatus']['name'] ?><em> (<?php echo count($status['EventParticipant']) ?>)</em></h3>
<?php if (!empty($status['EventParticipant'])) : ?>
<ul class="ui-custom-list">
<?php foreach ($status['EventParticipant'] as $participant) : ?>
<li>
<ul class="float-left">
<li><?php echo $this->Html->link($participant['Character']['name'], array('controller' => 'users', 'action' => 'view', $participant['User']['id']), array('class' => 'color-c' . $participant['Character']['class'])) ?></li>
<?php if ($participant['message']) : ?>
<li><div class="link-rem">&laquo; <?php echo $participant['message'] ?> &raquo;</div></li>
<?php endif ?>
</ul>
<ul class="float-right">
<?php if (AclComponent::hasRole('moderate_events')) : ?>
<?php if ($participant['confirmed']) : ?>
<li class="link-desc">Confirmé</li>
<?php else : ?>
<li class="link-desc"><?php echo $this->Html->link('Confirmer', array('controller' => 'eventParticipants', 'action' => 'confirm', $participant['id'])) ?></li>
<?php endif ?>
<?php endif ?>
<li class="link-desc"><?php echo $this->Time->timeAgoInWords($participant['answered']) ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
<?php else : ?>
<p class="link-desc">Il n'y a actuellement aucune réponse</p>
<?php endif ?>
</div>
<?php endforeach ?>
<?php if ($event['Event']['created_by'] == AuthComponent::user('id') || AclComponent::hasRole('moderate_event')): ?>
<div class="section-action">
<?php echo $this->Html->link("Editer", array('controller' => 'events', 'action' => 'edit', $event['Event']['id']), array('class' => 'ui-button')) ?>
<?php echo $this->Html->link("Supprimer", array('controller' => 'events', 'action' => 'delete', $event['Event']['id']), null, "Voulez-vous vraiment supprimer cet évènement ?") ?>
</div>
<?php endif ?>
