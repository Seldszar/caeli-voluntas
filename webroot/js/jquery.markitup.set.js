mySettings = {
	markupSet: [
		{ name: 'Gras', key: 'B', openWith: '[b]', closeWith: '[/b]' },
		{ name: 'Italique', key: 'I', openWith: '[i]', closeWith: '[/i]' },
		{ name: 'Souligné', key: 'U', openWith: '[u]', closeWith: '[/u]' },
		{ name: 'Barré', key: 'S', openWith: '[s]', closeWith: '[/s]' },
		{ separator: ' ' },
		{ name: 'Taille', openWith: '[size=[![Taille de la police :]!]]', closeWith: '[/size]' },
		{ name: 'Couleur', openWith: '[color=[![Couleur de la police :]!]]', closeWith: '[/color]' },
		{ separator: ' ' },
		{ name: 'Image', key: 'P', replaceWith: '[img][![URL de l\'image :]!][/img]' },
		{ name: 'Lien', key: 'L', openWith: '[url=[![URL du lien :]!]]', closeWith: '[/url]', placeHolder: 'Your text to link here...' },
		{ separator: ' ' },
		{ name: 'Liste non ordonnée', openWith: '[list]\n', closeWith: '\n[/list]' },
		{ name: 'Liste ordonnée', openWith: '[list=[![Début de la numérotation :]!]]\n', closeWith: '\n[/list]' },
		{ name: 'Elément de liste', openWith: '[*] ' },
		{ separator: ' ' },
		{ name: 'Citation', openWith: '[quote]', closeWith: '[/quote]' },
		{ name: 'Code', openWith: '[code]', closeWith: '[/code]' }
	]
}
