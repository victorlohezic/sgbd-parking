-- ============================================================
--   Table : COMMUNE                                            
-- ============================================================
create table COMMUNE (
	ID_COMMUNE serial PRIMARY KEY,
	NOM VARCHAR (50) NOT NULL,
	CODE_POSTAL INT   NOT NULL
);

-- ============================================================
--   Table : VEHICULE                                            
-- ============================================================
create table VEHICULE (
	NUMERO_IMMATRICULATION VARCHAR(9) PRIMARY KEY,
	MARQUE VARCHAR (50) NOT NULL,
	DATE_MISE_EN_CIRCULATION DATE NOT NULL,
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
	ADRESSE					VARCHAR(90)			not null,
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
	NUMERO_PARKING INT NOT NULL,
	foreign key (NUMERO_PARKING)
		references PARKING (ID_PARKING)
);

-- ============================================================
--   Table : TICKET                                        
-- ============================================================
create table TICKET (
	ID_TICKET serial PRIMARY KEY,
	DATE DATE NOT NULL,
	HEURE_ENTREE TIME,
	HEURE_SORTIE TIME,
	NUMERO_IMMATRICULATION VARCHAR(9) NOT NULL,
	ID_PLACE INT NOT NULL,
	foreign key (NUMERO_IMMATRICULATION)
		references VEHICULE (NUMERO_IMMATRICULATION),
	foreign key (ID_PLACE)
		references PLACE (ID_PLACE)
);
