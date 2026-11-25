<?php
declare(strict_types=1);

use ClasseTechnique\InterfaceSystem;
use ClasseMetier\Document;
use ClasseTechnique\Requete;

require $_SERVER['DOCUMENT_ROOT'] . "/../bootstrap/bootstrap.php";

$id = Requete::getInt('id');

// 2. Récupérer les informations du document
$document = Document::getById($id);

if (!$document) {
    $interface = new InterfaceSystem('Erreur', "Le document demandé $id n'existe pas en base de données.",  'erreur' );
    $interface->afficher();
}

// 3. Récupérer le nom du fichier stocké
$nomFichier = $document['nom_fichier'];

// 4. Définir le chemin complet vers le dossier physique sur le serveur

$cheminPdf =  $_SERVER['DOCUMENT_ROOT'] . '/data/document/' . $nomFichier;

// 5. Vérifier si le fichier existe et l'afficher dans le navigateur
if (file_exists($cheminPdf)) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($cheminPdf) . '"');
    header('Content-Length: ' . filesize($cheminPdf));

    readfile($cheminPdf);
    exit;
} else {
    $interface = new InterfaceSystem('Erreur', "Le fichier PDF est introuvable sur le serveur",  'erreur' );
    $interface->afficher();
}