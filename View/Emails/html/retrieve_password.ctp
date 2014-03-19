<h1 style="margin: 0 0 10px 0; margin-bottom: 10px">Récupération de votre mot de passe</h1>
<p style="margin: 0 0 10px 0; margin-bottom: 10px">Vous avez demander une réinitialisation de votre mot de passe.</p>
<p style="margin: 0 0 10px 0; margin-bottom: 10px">Si vous n'êtes pas à l'origine de celle-ci, veuillez supprimer au plus vite cet e-mail.</p>
<p style="margin: 0 0 20px 0; margin-bottom: 20px">Cliquez sur le lien ci-dessous pour confirmer votre inscription :</p>
<p style="font-size: 18px; margin: 0 0 10px 0; margin-bottom: 10px; text-align: center"><a style="color: #96A3BB; text-decoration: none" href="<?= $this->Html->url(array('action' => 'resetPassword', $salt), true) ?>">Réinitialiser mon mot de passe</a></p>
