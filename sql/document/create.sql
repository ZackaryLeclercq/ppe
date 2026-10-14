use ppe;

set default_storage_engine = innodb;
set foreign_key_checks = 0;

drop table if exists type;
drop table if exists documents;

CREATE TABLE type
(
    id		        INT 	auto_increment,
    libelle 		VARCHAR(100)	not null,

    constraint pk_type
        primary key (id)

)
    engine = innodb
    default character set = utf8mb4
    collate = utf8mb4_unicode_ci;


CREATE TABLE document
(
    id		        INT 	auto_increment,
    titre 		    VARCHAR(100) 	not null,
    nom_fichier 	VARCHAR(100) 	not null,
    id_type	        INT 	not null,

    constraint pk_documents
        primary key (id),

    constraint fk_documents_type
        foreign key (id_type)
            references type(id)
)
    engine = innodb
    default character set = utf8mb4
    collate = utf8mb4_unicode_ci;

set foreign_key_checks = 1;