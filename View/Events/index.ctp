<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Évènements') ?>

<?php $this->assign('header.image', 'events') ?>
<?php $this->assign('header.title', 'Evènements') ?>

<?php if (!empty($events)) : ?>
<?php foreach ($events as $date => $_events) : ?>
<div class="section">
<h3><?php echo $this->Time->format('l j F', $date) ?></h3>
<ul class="ui-custom-list">
<?php foreach ($_events as $event) : ?>
<li>
<ul class="float-left">
<li><?php echo $this->Html->link($event['Event']['name'], array('action' => 'view', $event['Event']['id'])) ?></li>
<li class="link-desc"><?php echo $event['EventType']['name'] ?></li>
</ul>
<ul class="float-right">
<li class="link-desc"><?php echo $this->Time->format('H:i', $event['Event']['begin']) ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
</div>
<?php endforeach ?>
<?php else : ?>
<h2 class="caption-empty">Il n'y a actuellement aucun évènement à venir</h2>
<?php endif ?>
<?php if (AclComponent::hasRole('create_event')): ?>
<div class="section-action">
<?php echo $this->Html->link('Ajouter un événement', array('action' => 'create'), array('class' => 'ui-button')) ?>
</div>
<?php endif ?>
