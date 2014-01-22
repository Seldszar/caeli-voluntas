<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Blog') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Blog') ?>

<ul class="ui-custom-list">
<?php foreach($articles as $article): ?>
<li>
<?= $this->Html->link($article['BlogArticle']['title'], array('action' => 'edit', $article['BlogArticle']['id'], 'admin' => true)) ?>
<div class="link-desc"><?php echo $this->Time->timeAgoInWords($article['BlogArticle']['created']) ?> par <?= $article['CreatedBy']['username'] ?></div>
</li>
<?php endforeach ?>
</ul>
<div class="section-action">
<?= $this->Html->link('Ajouter un article', array('action' => 'create'), array('class' => 'ui-button')) ?>
</div>
