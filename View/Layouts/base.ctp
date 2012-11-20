<!DOCTYPE html>
<html>
<head>
<title><?php echo $this->Html->getCrumbListStr(" - ", "Caeli Voluntas") ?></title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<link rel="favicon" href="<?php echo $this->Html->url('/img/favicon.png') ?>" type="image/png" />
<?php echo $this->Html->css(array('https://fonts.googleapis.com/css?family=Oswald:300|Open+Sans|Open+Sans:400italic|Open+Sans:600|Open+Sans:600italic', 'global', 'markitup')); ?>
<?php echo $this->Html->script('modernizr') ?>
<script type="text/javascript">Modernizr.load({ test: Modernizr.fontface, nope: 'js/cufon.js' });</script>
</head>
<body id="<?php echo $this->fetch('body.id') ?>" class="<?php echo $this->fetch('body.class') ?>">
<div id="background"></div>
<div id="page">
<div id="header">
<a id="logo" href="<?php echo $this->Html->url(array('controller' => 'blog', 'action' => 'index', 'admin' => false)) ?>"></a>
<?php if (AuthComponent::user()) : ?>
<div id="profile">
<div id="profile-avatar">
<?php echo $this->Html->image(AuthComponent::user('avatar_url')) ?>
</div>
<div id="profile-meta">
<?php echo $this->Html->link("Mon profil", array('controller' => 'users', 'action' => 'index', 'admin' => false)) ?>
<?php echo $this->Html->link("Se déconnecter", array('controller' => 'users', 'action' => 'logout', 'admin' => false), array('class' => 'fs11')) ?>
</div>
</div>
<?php else : ?>
<div id="user-actions">
<?php echo $this->Html->link("Se connecter", array('controller' => 'users', 'action' => 'login', 'admin' => false), array('id' => 'login-action')) ?>
<?php echo $this->Html->link("S'inscrire", array('controller' => 'users', 'action' => 'register', 'admin' => false)) ?>
</div>
<?php endif ?>
</div>
<div id="menu">
<ul>
<li><?php echo $this->Html->link('Forums', array('controller' => 'forums', 'action' => 'index', 'admin' => false)) ?></li>
<li><?php echo $this->Html->link('Roster', array('controller' => 'roster', 'action' => 'index', 'admin' => false)) ?></li>
<li><?php echo $this->Html->link('Galerie', array('controller' => 'gallery', 'action' => 'index', 'admin' => false)) ?></li>
<li><?php echo $this->Html->link('Charte', array('controller' => 'rules', 'action' => 'index', 'admin' => false)) ?></li>
<li><?php echo $this->Html->link('Evènements', 'http://events.caeli-voluntas.fr/', array('target' => '_blank')) ?></li>
</ul>
</div>
<div id="topbar">
<ul class="float-left">
<div id="breadcrumb">
<?php echo $this->Html->getCrumbList(null, "Caeli Voluntas") ?>
</div>
</ul>
</div>
<div id="content">
<?php echo $this->fetch('_content') ?>
</div>
<div id="footer">
<div class="footer-group" id="footer-links">
<h3><span class="icon-globe"></span>Liens externes</h3>
<div class="footer-group-content">
<?php echo $this->Html->link('Battle.net', 'http://eu.battle.net/') ?>
<?php echo $this->Html->link('WowProgress', 'http://www.wowprogress.com/') ?>
<?php echo $this->Html->link('World of Logs', 'http://www.worldoflogs.com/') ?>
<?php echo $this->Html->link('Elitist Jerks', 'http://elitistjerks.com/') ?>
<?php echo $this->Html->link('Curse', 'http://www.curse.com/') ?>
<?php echo $this->Html->link('Ask Mr. Robot', 'http://www.askmrrobot.com/') ?>
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
<div id="copyright">&copy; Caeli Voluntas 2012 - Tous droits réservés</div>
<div id="created-by">Développé par Alexandre B. (<?php echo $this->Html->link('Seldszar', array('controller' => 'users', 'action' => 'view', 2)) ?>) avec <?php echo $this->Html->link('CakePHP', 'http://cakephp.org/') ?></div>
</div>
</div>
</div>
</div>
<?php echo $this->Html->script(array('jquery', 'jquery.markitup', 'jquery.markitup.set', 'jquery.autosize', 'jquery-ui', 'common', 'toolbar')); ?>
<?php if ($this->fetch('scripts')) : ?>
<script type="text/javascript">
<?php echo $this->fetch('scripts') ?>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-35239300-1']);
_gaq.push(['_setDomainName', 'caeli-voluntas.fr']);
_gaq.push(['_trackPageview']);
(function(){var ga=document.createElement('script');ga.type='text/javascript';ga.async=true;ga.src=('https:'==document.location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s);})();
</script>
<?php endif ?>
</body>
</html>