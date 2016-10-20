# bootstrap angular template #

template html bootstrap angular pour démarrer un projet rapidement  
Ce template embarque:

*   Bootstrap (tout les modules ne sont pas chargés)
*   Jquery (Pour bootstrap. Il est déconséillé de l'utiliser, prefferez angular)
*   AngularJs
*   Angular-bootstrap (pour la compatibilité avec Bootstrap)
*   Angular-route (pour le routing)

## Dépendences

*   Gulp

## Installation

Pour installer le projet lancez :  

    npm install  
    bower install

Pour lancer la premiere compilation (nécéssite gulp)

    gulp dev

## Bootstrap

Par défaut le template charge les module bootstrap suivants :

*   variables
*   normalize
*   print
*   glyphicons
*   grid-framework
*   grid
*   button

vous pouvez en charger d'autres en les ajoutant dans la config

## Outils de production

Gulp est installé avec les taches principales suivantes :

<dl>

<dt>dev</dt>

<dd>Compile les less, concatene les js et déplace les fichiers satiques</dd>

<dt>watchDev</dt>

<dd>comme dev mais avec un watch sur les fichiers de l'app</dd>

<dt>server</dt>

<dd>watchDev assorti d'un server en livereload sur le port 4000 (changeable dans la config)</dd>

</dl>
