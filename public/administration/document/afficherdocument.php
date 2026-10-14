<?php
declare(strict_types=1);

use ClasseMetier\Document;
use ClasseTechnique\Requete;
use ClasseTechnique\UserException;

/** @noinspection PhpIncludeInspection */
require $_SERVER['DOCUMENT_ROOT'] . "/../bootstrap/bootstrap.php";

// Démarrage de la session si nécessaire pour vérifier les droits d'accès
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Lecture et validation du paramètre GET
$id = Requete::getInt('id');

// Recherche du document
$document = Document::getById($id);

if ($document === null) {
    throw new UserException("Le document n'existe pas.");
}

// Contrôle d'accès : Si le document est réservé aux membres, on vérifie la session
if (isset($document['type_libelle']) && $document['type_libelle'] === 'Membre' && !isset($_SESSION['id_membre'])) {
    throw new UserException(message: "Accès refusé. Vous devez être connecté en tant que membre pour consulter ce document.");
}

// Répertoire physique des PDF
$fichier = DOSSIER_DOCUMENT . DIRECTORY_SEPARATOR . $document['nom_fichier'];

if (!is_file($fichier)) {
    throw new UserException(message: "Le fichier PDF demandé '{$document['titre']}' n'a pas été trouvé.");
}

// Affichage du PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $document['nom_fichier'] . '"');
header('Content-Length: ' . filesize($fichier));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

readfile($fichier);
exit();