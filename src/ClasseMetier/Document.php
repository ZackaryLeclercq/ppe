<?php
declare(strict_types=1);

namespace ClasseMetier;

use ClasseTechnique\ColumnInt;
use ClasseTechnique\ColumnText;
use ClasseTechnique\Select;
use ClasseTechnique\Table;

/**
 * Classe Document
 *
 * Gestion des documents PDF associés à l'application.
 *
 * @author Zackary Leclercq
 */
class Document extends Table
{

    /**
     * Configuration de la table.
     */
    protected function configure(): void
    {
        $this->table = 'document';
        $this->primaryKey = 'id';

        $this->addColumn('titre', new ColumnText(
            required: true,
            insertable: true,
            updatable: true,
            pattern: "^[a-zA-ZÀ-ÿçÇ0-9]([ '\-]?[a-zA-ZÀ-ÿçÇ0-9]*)*$",
            minLength: 3,
            maxLength: 100,
            supprimerEspaceSuperflu: true
        ));

        $this->addColumn('nom_fichier', new ColumnText(
            required: true,
            insertable: true,
            updatable: false,
            maxLength: 100
        ));

        $this->addColumn('id_type', new ColumnInt(
            required: true,
            insertable: true,
            updatable: true
        ));
    }



    // -----------------------------------------------------------------------
    // Méthodes statiques de consultation
    // -----------------------------------------------------------------------

    /**
     * Retourne tous les documents avec leur type.
     */
    public static function getAll(): array
    {
        $sql = <<<SQL
            SELECT document.id, document.titre, document.nom_fichier, document.id_type, type.libelle as type_libelle
            FROM document
            JOIN type ON document.id_type = type.id
            ORDER BY document.titre
        SQL;
        $select = new Select();
        return $select->getRows($sql);
    }

    /**
     * Récupère un document par son identifiant avec son type.
     */
    public static function getById(int $id): ?array
    {
        $sql = <<<SQL
            SELECT document.id, document.titre, document.nom_fichier, document.id_type, type.libelle as type_libelle
            FROM document
            JOIN type ON document.id_type = type.id
            WHERE document.id = :id
        SQL;
        $select = new Select();
        return $select->getRow($sql, ['id' => $id]);
    }
}