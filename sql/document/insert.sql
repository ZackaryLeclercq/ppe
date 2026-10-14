use ppe;

-- Insertion des types de documents
INSERT INTO type (id, libelle) VALUES
(1, '4 saisons'),
(2, 'Club'),
(3, 'Public'),
(4, 'Membre');

-- Insertion des documents initiaux avec id_type
INSERT INTO document (titre, nom_fichier, id_type) VALUES
('Autorisation parentale 4 saisons', 'Autorisation parentale 4 saisons.pdf', 1),
('Autorisation parentale pour adhesion', 'Autorisation parentale pour adhesion.pdf', 2),
('Estimation des temps par distance en fonction de votre VMA', 'Estimation des temps par distance en fonction de votre VMA.pdf', 4),
('HALL OF FAME du VDS règlement', 'HALL OF FAME du VDS reglement.pdf', 4),
('HALL OF FAME', 'HALL OF FAME.pdf', 4),
('Les minimas pour les championnats de France', 'Les minimas pour les championnats de France.pdf', 3),
('Règlement des 4 saisons', 'Reglement des 4 saisons.pdf', 1),
('Règlement intérieur 2022', 'Reglement interieur 2022.pdf', 2),
('Séances VMA', 'seances vma.pdf', 4),
('Statuts', 'statuts.pdf', 2),
('Tableau des allures pour les Sorties Longues', 'Tableau des allures pour les Sorties Longues.pdf', 4),
('Tableau des allures pour séances de VS', 'Tableau des allures pour seances de VS.pdf', 4);