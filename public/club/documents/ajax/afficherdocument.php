<?php
declare(strict_types=1);

use ClasseMetier\Document;

require_once $_SERVER['DOCUMENT_ROOT'] . "/../bootstrap/bootstrap.php";

header('Content-Type: application/json; charset=utf-8');

try {
    // Récupération de tous les documents
    $documents = Document::getAll();

    // Filtrage pour ne garder que le type Club (id_type = 2)
    $documentsClub = array_filter($documents, function ($doc) {
        return (int)$doc['id_type'] === 2;
    });

    // Réindexation du tableau pour conserver un format JSON propre
    echo json_encode(array_values($documentsClub));
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['erreur' => $e->getMessage()]);
}
exit();