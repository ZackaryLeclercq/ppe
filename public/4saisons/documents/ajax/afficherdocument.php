<?php
declare(strict_types=1);

use ClasseMetier\Document;
use ClasseTechnique\ReponseJson;

require $_SERVER['DOCUMENT_ROOT'] . "/../bootstrap/bootstrap.php";

// Récupération uniquement des documents de type Club (id_type = 1)
$lesDocuments = Document::getByType(1);

ReponseJson::envoyerLesDonnees($lesDocuments);