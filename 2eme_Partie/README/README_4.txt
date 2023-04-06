------------------------------------------------------
				 SAE 1.03 - C1
					Etape 2
				Génération des fichiers html
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
- Les dossiers contenant : les photos des commerciaux générée en .png et en noir et blanc contenues dans le dossier pp et les textes des régions formatés générés dans le
- dossier resultat
-----

----- Installation
- 
- Avant de lancer l'exécutable, vous devrez télécharger l'image requise à l'aide de la commande: docker image pull sae103-php
-
-----

----- Lancement
-
- docker run --rm -ti -v $(pwd):/work sae103-php ./templateHTML.php <code ISO> html
- Cette commande va afficher dans la console la version html de la région
-
-----
-
- ./html.bash
- Cette commande va générer tous les fichiers .html dans le dossier html en prenant les textes dans le dossier Textes et les logos dans le dossier logo et les avatar dans - le dossier pp.
-
----
