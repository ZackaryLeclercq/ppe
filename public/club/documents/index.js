"use strict";

// -----------------------------------------------------------------------------------
// Import des fonctions nécessaires
// -----------------------------------------------------------------------------------

import {appelAjax} from "/composant/fonction/ajax.js";
import {genererMessage} from "/composant/fonction/afficher.js";


// -----------------------------------------------------------------------------------
// Déclaration des variables globales
// -----------------------------------------------------------------------------------

const conteneurDocuments = document.getElementById('conteneur-documents');

// -----------------------------------------------------------------------------------
// Fonctions de traitement
// -----------------------------------------------------------------------------------

function chargerDocuments() {
    conteneurDocuments.textContent = "Chargement des documents...";

    appelAjax({
        url: '/club/documents/ajax/afficherdocument.php',
        success: (data) => {
            conteneurDocuments.textContent = "";

            if (!data || data.length === 0) {
                conteneurDocuments.appendChild(genererMessage("Aucun document n'est disponible pour le moment.", 'bleu'));
                return;
            }

            // Création de la table en manipulation DOM pure
            const table = document.createElement('table');
            table.className = 'table table-striped';

            const thead = document.createElement('thead');
            const trHead = document.createElement('tr');

            const thTitre = document.createElement('th');
            thTitre.textContent = "Titre du document";

            const thAction = document.createElement('th');
            thAction.textContent = "Action";

            trHead.append(thTitre, thAction);
            thead.appendChild(trHead);
            table.appendChild(thead);

            const tbody = document.createElement('tbody');

            data.forEach(doc => {
                const tr = document.createElement('tr');

                const tdTitre = document.createElement('td');
                tdTitre.textContent = doc.titre; // Sécurisé nativement contre les injections XSS

                const tdAction = document.createElement('td');
                const lien = document.createElement('a');
                lien.href = `/afficherdocument.php?id=${doc.id}`;
                lien.className = 'btn btn-primary btn-sm';
                lien.target = '_blank';
                lien.textContent = "Consulter / Télécharger";

                tdAction.appendChild(lien);
                tr.append(tdTitre, tdAction);
                tbody.appendChild(tr);
            });

            table.appendChild(tbody);
            conteneurDocuments.appendChild(table);
        },
        error: () => {
            conteneurDocuments.textContent = "";
            conteneurDocuments.appendChild(genererMessage("Impossible de charger les documents.", 'rouge'));
        }
    });
}


// -----------------------------------------------------------------------------------
// Programme principal
// -----------------------------------------------------------------------------------

chargerDocuments();