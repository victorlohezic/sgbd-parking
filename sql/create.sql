-- ============================================================
--   Table : COMMUNE                                            
-- ============================================================
create table COMMUNE (
	ID_COMMUNE serial PRIMARY KEY,
	NOM VARCHAR (50) NOT NULL,
	CODE_POSTAL INT   NOT NULL
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
	constraint pk_parking primary key (ID_PARKING)
);