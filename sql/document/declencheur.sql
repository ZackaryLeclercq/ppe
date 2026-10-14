use ppe;

drop trigger if exists avantAjoutDocument;

delimiter $$

create trigger avantAjoutDocument
    before insert
    on document
    for each row

begin

    if new.nom_fichier not like '%.pdf' then
        signal sqlstate '45000'
            set message_text = 'Le fichier doit être en format PDF';
    end if;
end
$$

delimiter ;