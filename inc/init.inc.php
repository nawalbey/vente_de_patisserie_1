<?php

/* ⚠ Il faut inclure le fichier autoload AVANT d'exécuter la fonction session_start() sinon il y aura
        une error si on essaye de stocker un objet dans la variable superglobale $_SESSION */
require "autoload.php";
session_start();
include __DIR__ . "/functions.inc.php";
define("ROOT", "/vente_de_patisserie_1/");
define("ROLE_USER", "ROLE_USER");
define("ROLE_ADMIN", "ROLE_ADMIN");
define("INSERTED", "Enregistrer");
define("UPDATED", "Modifier");
define("DELETED", "Spprimr");
define("UPLOAD_GATEAUX_IMG", "uploads/gateaux/");
define("EN_ATTENTE", "En Attente");