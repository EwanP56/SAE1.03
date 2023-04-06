------------------------------------------------------
				 SAE 1.03 - C1
					Etape 2
				Génération image
------------------------------------------------------

----- Sommaire
- 
- Prérequis
- Installation
- Lancement
-----


----- Prérequis
- 
- Linux
- Docker
- Le dossier avec les photos des clients
-----

----- Installation
- 
- docker image pull sae103-imagick 
- (nécessaire afin de faire marcher la commande de le fichier image.bash)
-----

----- Lancement
-
- docker run --rm -ti -v $(pwd):/work sae103-imagick ./image.bash
-----
