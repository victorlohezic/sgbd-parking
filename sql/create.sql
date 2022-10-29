-- ============================================================
--   Table : COMMUNE                                            
-- ============================================================
create table COMMUNE (
	ID_COMMUNE serial PRIMARY KEY,
	NOM VARCHAR (50) NOT NULL,
	CODE_POSTAL INT   NOT NULL
);