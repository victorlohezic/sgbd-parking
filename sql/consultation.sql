-- ============================================================
--    Consultation
-- ============================================================

-- Informations sur les parkings
select *
from PARKING;

-- Informations sur les voitures 
select * 
from VEHICULE;

-- Informations sur les places 
select * 
from PLACE;

-- Liste voitures par parking

select VEHICULE, NOM_PARKING
from (((VEHICULE inner join TICKET using (NUMERO_IMMATRICULATION))
    inner join PLACE using (ID_PLACE))
        inner join PARKING using(ID_PARKING));

-- Liste parkings par commune

select NOM_PARKING,ADRESSE_PARKING,NOM_COMMUNE
from PARKING P,COMMUNE C
where P.ID_COMMUNE = C.ID_COMMUNE;


-- Liste de voitures s'étant garé dans deux parkings différents la même journée

select NUMERO_IMMATRICULATION, DATE_TICKET
from TICKET
group by NUMERO_IMMATRICULATION, DATE_TICKET having count(NUMERO_IMMATRICULATION) > 1 and count(DATE_TICKET)=2;

-- Nombre de places par parking

select NOM_PARKING, count(ID_PLACE)
from (PARKING left outer join PLACE using (ID_PARKING))
group by NOM_PARKING;

-- Liste des parkings ayant un nombre de places supérieur à 0
SELECT ID_PARKING
from PLACE
group by ID_PARKING
having count(ID_PLACE)=3;

-- Liste des tickets actuellement valides à une date donnée, ici '2020-12-30' et à un heure donnée 19:49:27 du parking
SELECT count(*)
from TICKET 
natural join PLACE
natural join PARKING
where DATE_TICKET = '2020-12-30' and HEURE_SORTIE > '19:49:27' and ID_PARKING=3;

-- Liste des parkings qui sont saturés à un jour donnée
SELECT P.NOM_PARKING, P.ID_PARKING
from PLACE
natural join PARKING P
group by P.NOM_PARKING, P.ID_PARKING
having count(ID_PLACE) = (
    SELECT count(*)
    from TICKET 
    natural join PLACE
    natural join PARKING
    where DATE_TICKET = '2020-12-30' and HEURE_SORTIE > '19:49:27' and ID_PARKING=P.ID_PARKING
);

-- Nombre de place en parking 
select P.ID_PARKING, P.NOM_PARKING, count(*) - (
    SELECT count(*)
    from TICKET 
    natural join PLACE
    natural join PARKING
    where DATE_TICKET = '2020-12-30' and HEURE_SORTIE > '19:49:27' and ID_PARKING=P.ID_PARKING
)
from PLACE
natural join PARKING P
group by P.NOM_PARKING, P.ID_PARKING;