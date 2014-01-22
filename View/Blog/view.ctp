<?php $this->assign('header.image', 'blog') ?>
<?php $this->assign('header.title', $article['BlogArticle']['title']) ?>

<?php $this->start('header.description') ?>
<div class="by-line"><?php echo $this->Time->timeAgoInWords($article['BlogArticle']['created']) ?> par <?= $this->Html->link($article['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $article['CreatedBy']['id'])) ?></div>
<?php $this->end() ?>

<?php $this->Html->addCrumb($article['BlogArticle']['title']) ?>

<?= $this->Parser->parseAsString($article['BlogArticle']['content'], 'bbcode') ?>
