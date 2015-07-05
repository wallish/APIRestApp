1er étape : réalisation de la BDD (user)
-> 3 jeux en BDD
2ème étape : Conception du fichier XML
3ème étape : Validation avec le sxd
étape intermédiaire : lorsque l'on fait un get on ne va pas génerer tout le XML
-> trouver une solution pour ne pas avoir de redondance dans le schema xsd
API :
> Routing
> Liaison avec PDO
> Sécurisé l'accès à l'API via une signature
> POST PUT DELETE GET (pour un jeu)

Interface :
> 2
	- Listing de tous les jeux
	- Détail d'un jeu
> Plusieurs script PHP (pas de formulaire)
	- PUT (modification d'un jeu)
	- DELETE 
	- POST
> XPAST
> CURL
> XML
> json_encode / decode
> check le http code == 201 if created
> retourner le bon http code en cas d'erreura
> $_server request_method
> permission différentes (acl)
> vérifier les données en post (type)

> 2 role : admin et user
> transmettre API + DOC + dump + indentifiant
> interface
	-listing de tous les jeux
	-détail d'un jeu
	-formulaire d'ajout avec merge d'un array static
	-modification d'un jeu et les supprimer

oral
presenter l'auth
les verbes 



------------------------------------------------------------------
## FRONT ##


# POST #

un json doit être récupéré, il doit être convertie en array sous cette forme : 

```php
array(
	'table' => array(
		'champ1' => 'foo',
		'champ2' => 'bar',
	),
);
```
Exemple concret :

array php :

array(
	'game' => array(
    	'jeu_titre' => 'sf4',
    	'jeu_description' => 'jeu de combat',
    	'jeu_site_web' => 'www.foo.com',
    ),
);

json : 

{
  "game": {
    "jeu_titre": "sf4",
    "jeu_description": "jeu de combat",
    "jeu_site_web": "www.foo.com"
  }
}

## array static à merge (à convertir en json) ##

$to_merge = array(
	'media' =>  array(
		'media_url' => 'http://www.jeux-consoles.net/img/9729_mario_sonic.jpg', 
		'media_media_type_id' => 1
		),
	'console' => array(
		'console_nom' => 'Console Test',
		'console_date_sortie' => '2013-11-22 00:00:00',
		'console_prix' => "100"
		),
	'caracteristique' => array(
		'console_nom' => 'Console Test',
		'console_date_sortie' => '2013-11-22 00:00:00',
		'console_prix' => "100"
		),
	'console_caracteristique' => array(
		array('console_caracteristique_caracteristique_id' => 1, 'console_caracteristique_valeur' => "static cpu"),
		array('console_caracteristique_caracteristique_id' => 2, 'console_caracteristique_valeur' => "static gpu"),
		array('console_caracteristique_caracteristique_id' => 3, 'console_caracteristique_valeur' => "static ram"),
		array('console_caracteristique_caracteristique_id' => 4, 'console_caracteristique_valeur' => "static kg"),
		array('console_caracteristique_caracteristique_id' => 5, 'console_caracteristique_valeur' => "static lecteur"),
		array('console_caracteristique_caracteristique_id' => 6, 'console_caracteristique_valeur' => "static hd"),
		array('console_caracteristique_caracteristique_id' => 7, 'console_caracteristique_valeur' => "static Bluetooth"),
		array('console_caracteristique_caracteristique_id' => 8, 'console_caracteristique_valeur' => "static wifi"),
		array('console_caracteristique_caracteristique_id' => 9, 'console_caracteristique_valeur' => "static usb"),
		array('console_caracteristique_caracteristique_id' => 10, 'console_caracteristique_valeur' => "static manette"),
		array('console_caracteristique_caracteristique_id' => 11, 'console_caracteristique_valeur' => "static volt"),
		array('console_caracteristique_caracteristique_id' => 12, 'console_caracteristique_valeur' => "static go"),
		),
	'commentaire' => array(
		array(
			'commentaire_utilisateur' => 'static user', 
			'commentaire_date' => date('Y-m-d'),
			'commentaire_note' => 18, 
			'commentaire_contenu' => 'static comment'
		),
	),
	'jeu_console' => array(
		'jeu_console_date_sortie' => '2015-11-18 00:00:00', 
		'jeu_console_prix' => '50', 
		'jeu_console_classification' => '+3'
		),
);

# UPDATE #

Pour l'instant, il y a que la table jeu qui peut-être update, ne pas oublier de fournir l'id

format type : 

{
  "game": {
    "jeu_id": "2",
    "jeu_titre": "sf4",
    "jeu_description": "jeu de combat",
    "jeu_site_web": "www.foo.com"
  }
}

# DELETE #

désactivation du jeu (champ deleted) = delete

url : /game/delete/id/$id
