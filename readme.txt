1er étape : réalisation de la BDD (user)
-> 3 jeux en BDD
2ème étape : Conception du fichier XML
3ème étape : Validation avec le sxd

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