<?php $this->Html->addCrumb("Roster de la guilde") ?>

<?php $this->assign('header.image', 'roster') ?>
<?php $this->assign('header.title', 'Roster de la guilde') ?>
<?php $this->assign('content.class', 'no-padding') ?>

<div id="roster">
    <?php foreach ($groups as $group) : ?>
        <div class="roster-class">
            <h2><?php echo $group['Group']['name'] ?></h2>
            <div class="roster-characters">
                <?php foreach ($group['User'] as $k => $user) : ?>
                    <?= $this->Html->link($this->Html->image($user['avatar_url'], array('title' => $user['username'])), array('controller' => 'users', 'action' => 'view', $user['id']), array('escape' => false, 'class' => array('roster-character', ($k < 2 ? 'first' : null)))) ?>
                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
