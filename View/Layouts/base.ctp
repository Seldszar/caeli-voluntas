<!DOCTYPE html>
<html>
<head>
<title><?php echo $this->Html->getCrumbListStr(" - ", "Caeli Voluntas") ?></title>
<?= $this->Html->charset() ?>
<?= $this->Html->meta('icon', $this->Html->url('/img/favicon.png')) ?>
<?= $this->Html->css(array('global', 'markitup')); ?>
</head>
<body id="<?php echo $this->fetch('body.id') ?>" class="<?php echo $this->fetch('body.class') ?>">
<div id="background"></div>
<div id="page">
<div id="header">
<a id="logo" href="<?php echo $this->Html->url(array('controller' => 'blog', 'action' => 'index', 'admin' => false)) ?>"></a>
<?php if ($this->Auth->user()) : ?>
<div id="profile">
<div id="profile-avatar">
<?= $this->Html->image($this->Auth->user('avatar_url')) ?>
</div>
<div id="profile-meta">
<?= $this->Html->link("Mon profil", array('controller' => 'users', 'action' => 'view', $this->Auth->user('id'), 'admin' => false)) ?>
<?= $this->Html->link("Se déconnecter", array('controller' => 'users', 'action' => 'logout', 'admin' => false), array('class' => 'fs11')) ?>
</div>
</div>
<?php else : ?>
<div id="user-actions">
<?= $this->Html->link("Se connecter", array('controller' => 'users', 'action' => 'login', 'admin' => false), array('id' => 'login-action')) ?>
<?= $this->Html->link("S'inscrire", array('controller' => 'users', 'action' => 'register', 'admin' => false)) ?>
</div>
<?php endif ?>
</div>
<div id="menu">
<ul>
<li><?php echo $this->Html->link('Forums', array('controller' => 'forums', 'action' => 'index', 'admin' => false)) ?></li>
<li><?php echo $this->Html->link('Roster', array('controller' => 'roster', 'action' => 'index', 'admin' => false)) ?></li>
<li><?php echo $this->Html->link('Galerie', array('controller' => 'gallery', 'action' => 'index', 'admin' => false)) ?></li>
<li><?php echo $this->Html->link('Charte', array('controller' => 'rules', 'action' => 'index', 'admin' => false)) ?></li>
<li><?php echo $this->Html->link('Evènements', '//events.caeli-voluntas.fr') ?></li>
</ul>
</div>
<div id="breadcrumb">
<?= $this->Html->getCrumbList(null, "Caeli Voluntas") ?>
</div>
<div id="content">
<?= $this->fetch('_content') ?>
</div>
<div id="footer">
<div class="footer-group" id="footer-links">
<h3><span class="icon-globe"></span>Liens externes</h3>
<div class="footer-group-content">
<?= $this->Html->link('Battle.net', 'http://eu.battle.net/', array('target' => '_blank')) ?>
<?= $this->Html->link('WowProgress', 'http://www.wowprogress.com/', array('target' => '_blank')) ?>
<?= $this->Html->link('World of Logs', 'http://www.worldoflogs.com/', array('target' => '_blank')) ?>
<?= $this->Html->link('Elitist Jerks', 'http://elitistjerks.com/', array('target' => '_blank')) ?>
<?= $this->Html->link('Curse', 'http://www.curse.com/', array('target' => '_blank')) ?>
<?= $this->Html->link('Ask Mr. Robot', 'http://www.askmrrobot.com/', array('target' => '_blank')) ?>
</div>
</div>
<div class="footer-group">
<h3><span class="icon-quote"></span>A propos</h3>
<div class="footer-group-content">
La guilde Caeli Voluntas est une guilde côté Alliance présente depuis plus de 7 ans. L'ambiance y est bonne enfant et c'est qui en fait tout son charme.
</div>
</div>
<div class="footer-group">
<h3><span class="icon-cog"></span>Informations complémentaires</h3>
<div class="footer-group-content">
<div id="copyright">&copy; Caeli Voluntas 2012-<?= date('Y') ?> - Tous droits réservés</div>
<div id="created-by">Website made with love by <?php echo $this->Html->link('Seldszar', '//seldszar.fr') ?></div>
</div>
</div>
</div>
</div>
<?= $this->Html->script(array('jquery', 'jquery.markitup', 'jquery.markitup.set', 'jquery.autosize', 'jquery-ui', 'common', 'toolbar')); ?>
<script>
<?= $this->fetch('scripts') ?>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-35239300-1']);
_gaq.push(['_setDomainName', 'caeli-voluntas.fr']);
_gaq.push(['_trackPageview']);
(function(){var ga=document.createElement('script');ga.type='text/javascript';ga.async=true;ga.src=('https:'==document.location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s);})();
</script>
</body>
</html>