-- ============================================================
--   Table : COMMUNE                                            
-- ============================================================
create table COMMUNE (
	ID_COMMUNE serial PRIMARY KEY,
	NOM_COMMUNE VARCHAR (50) NOT NULL,
	CODE_POSTAL INT   NOT NULL
);

-- ============================================================
--   Table : VEHICULE                                            
-- ============================================================
create table VEHICULE (
	NUMERO_IMMATRICULATION VARCHAR(9) PRIMARY KEY,
	MARQUE VARCHAR (50) NOT NULL,
	DATE_MISE_EN_CIRCULATION DATE NOT NULL CHECK (DATE_MISE_EN_CIRCULATION < NOW()::date),
	KILOMETRAGE INT,
	ETAT VARCHAR (50)
);

-- ============================================================
--   Table : PARKING                                         
-- ============================================================
create table PARKING
(
	ID_PARKING				INT					not null,
	NOM_PARKING				VARCHAR(50)					,
	ADRESSE_PARKING					VARCHAR(90)			not null,
	TARIF_HORAIRE			INT					not null,
	ID_COMMUNE				INT					not NULL,
	foreign key (ID_COMMUNE)
		references COMMUNE (ID_COMMUNE),
	constraint pk_parking primary key (ID_PARKING)
);

-- ============================================================
--   Table : PLACE                                            
-- ============================================================
create table PLACE (
	ID_PLACE serial PRIMARY KEY,
	NUMERO_PLACE VARCHAR (7) NOT NULL,
	ID_PARKING INT NOT NULL,
	foreign key (ID_PARKING)
		references PARKING (ID_PARKING) ON DELETE CASCADE
);

-- ============================================================
--   Table : TICKET                                        
-- ============================================================
create table TICKET (
	ID_TICKET serial PRIMARY KEY,
	DATE_TICKET DATE NOT NULL,
	HEURE_ENTREE TIME,
	HEURE_SORTIE TIME,
	NUMERO_IMMATRICULATION VARCHAR(9) NOT NULL,
	ID_PLACE INT NOT NULL,
	foreign key (NUMERO_IMMATRICULATION)
		references VEHICULE (NUMERO_IMMATRICULATION),
	foreign key (ID_PLACE)
		references PLACE (ID_PLACE) ON DELETE CASCADE
);

-- ============================================================
--   Trigger : PRESQUE_NEUF                             
-- ============================================================

create or replace function PRESQUE_NEUF() returns TRIGGER as $PRESQUE_NEUF$
    begin
        if new.ETAT = 'presque neuf' and new.KILOMETRAGE > 6000 then
            new.ETAT := 'bon';
        end if;
        return new;
    end;
$PRESQUE_NEUF$ LANGUAGE plpgsql;

create TRIGGER PRESQUE_NEUF before insert or update on VEHICULE
    for each row execute procedure PRESQUE_NEUF();


-- ============================================================
--   Trigger : ID_COMMUNE                          
-- ============================================================

create or replace function ID_COMMUNE() returns TRIGGER as $ID_COMMUNE$
	declare
		id_max	integer;
    begin
		SELECT count(NUMERO_IMMATRICULATION) into id_max from VEHICULE where NUMERO_IMMATRICULATION='00-000-00';
        if new.ID_COMMUNE < id_max 
		then
            new.ID_COMMUNE := id_max + 1;
        end if;
        return new;
    end;
$ID_COMMUNE$ LANGUAGE plpgsql;

create TRIGGER ID_COMMUNE before insert or update on COMMUNE
    for each row execute procedure ID_COMMUNE();
	
-- ============================================================
--   Trigger : SUPPRESSION_VEHICULE                          
-- ============================================================

create or replace function SUPPRESSION_VEHICULE() returns TRIGGER as $SUPPRESSION_VEHICULE$
	declare
		immatriculation_defaut	integer;
    begin
		SELECT count(NUMERO_IMMATRICULATION) into immatriculation_defaut from VEHICULE where NUMERO_IMMATRICULATION='00-000-00';
        if immatriculation_defaut = 0
		then
            insert into VEHICULE values ('00-000-00', 'defaut', NOW() - interval '2 year', 0, 'defaut');
        end if;
		update TICKET
		set NUMERO_IMMATRICULATION = '00-000-00'
		where NUMERO_IMMATRICULATION = old.NUMERO_IMMATRICULATION;
        return old;
    end;
$SUPPRESSION_VEHICULE$ LANGUAGE plpgsql;

create TRIGGER SUPPRESSION_VEHICULE before delete on VEHICULE
    for each row execute procedure SUPPRESSION_VEHICULE();

-- ============================================================
--   Procédure : MODIFICATION_VEHICULE                         
-- ============================================================
create or replace procedure rename(oldname VARCHAR, newname VARCHAR)
LANGUAGE plpgsql
as $$
begin
update PARKING
set NOM_PARKING=newname
where NOM_PARKING=oldname;
end
$$;