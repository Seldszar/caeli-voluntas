<?php

header($_SERVER['SERVER_PROTOCOL'] . " 503 Service Unavailable");

$randomMessages = array(
"Egalement présent en Pandarie",
"Propulsé par bottes-fusées",
"En partenariat avec l'organisme des joyeux nains éméchés",
"Aile-de-Mort n'a qu'à bien se tenir",
"Approuvé avec Genn Grisetête",
"Temblez devant notre puissance !",
"Trop appuyer sur F5 peut nuire à la santé de votre clavier",
"Encore toi ? Allez, du vent...",
"&lt;?php \$siteIndisponible = true; ?&gt;",
"Cerveau...",
"Eh oui ! Encore...",
"De jolies créatures de rêve vous attendent",
"Garanti 100% naturel",
"Vous êtes désormais sous notre contrôle...",
"Fus Roh... Oups je me suis trompé",
"Pour la H... l'Alliance !",
"By K.",
"Chut... C'est un secret",
"Le service que vous avez demandé est indisponible pour le moment<br />Merci de bien vouloir réessayer ultérieurement",
"C'est fort en chocolat !",
"Chuck Noris approuve son existance",
"Attention, chien méchant",
"Aime les chats",
"Elevé en plein air",
"Tu veux boire une bière pour patienter ?",
"C'est tous les jours Noël",
"Tout beau, tout propre !"
);

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Caeli Voluntas</title>
<?php echo $this->Html->charset() ?>
<?php echo $this->Html->meta(array('name' => 'robots', 'content' => 'noindex')) ?>
<?php echo $this->Html->meta('favicon.png', 'favicon.png', array('type' => 'icon')) ?>
<?php echo $this->Html->css(array('landing', 'https://fonts.googleapis.com/css?family=Oswald:300')) ?>
</head>
<body>
<div id="landing">
<div id="logo"></div>
<div id="landing-message"><?php echo $message ?></div>
<div id="landing-quote"><?php echo $randomMessages[array_rand($randomMessages)] ?></div>
</div>
</body>
</html>