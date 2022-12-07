-- ============================================================
--    Consultation
-- ============================================================
select count(ID_PARKING) from PARKING 
	natural join COMMUNE
	where NOM_PARKING = 'Village 1' and ID_COMMUNE in (select ID_COMMUNE from COMMUNE natural join PARKING where NOM_PARKING='Village 1');

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

-- Nombre de place disponibles, par parking, à un moment donnée
select P.ID_PARKING, P.NOM_PARKING, count(*) - (
    SELECT count(*)
    from TICKET 
    natural join PLACE
    natural join PARKING
    where DATE_TICKET = '2020-12-30' and HEURE_SORTIE > '16:49:27' and ID_PARKING=P.ID_PARKING
) as NOMBRE_PLACE_DISPONIBLE_PARKING
from PLACE
right outer join PARKING P
on PLACE.ID_PARKING = P.ID_PARKING
group by P.NOM_PARKING, P.ID_PARKING;

-- Liste des places disponibles par parking à un moment donnée
select distinct ID_PLACE, NUMERO_PLACE
from PLACE
left outer join PARKING using(ID_PARKING)
where NOM_PARKING='Village 1'
except
SELECT ID_PLACE, NUMERO_PLACE
from TICKET 
natural join PLACE
natural join PARKING
where DATE_TICKET = '2020-12-30' and HEURE_SORTIE > '16:49:27' and NOM_PARKING='Village 1';

-- Liste de voitures et leur parking l à un moment donnée
select NUMERO_IMMATRICULATION as NUMERO_IMMATRICULATION, NOM_PARKING as PARKING_ACTUEL
from VEHICULE 
left outer join TICKET using (NUMERO_IMMATRICULATION)
left outer join PLACE using (ID_PLACE)
left outer join PARKING using(ID_PARKING)
where DATE_TICKET = '2020-12-30' and HEURE_SORTIE > '10:49:27';

-- Liste de voitures garés et leur parking actuel 
select NUMERO_IMMATRICULATION, NOM_PARKING as PARKING_ACTUEL
from VEHICULE 
left outer join TICKET using (NUMERO_IMMATRICULATION)
left outer join PLACE using (ID_PLACE)
left outer join PARKING using(ID_PARKING)
where DATE_TICKET = NOW()::date and HEURE_SORTIE > NOW()::time;

-- Liste de voitures non garé actuellement
select distinct on (NUMERO_IMMATRICULATION) NUMERO_IMMATRICULATION
from VEHICULE 
left outer join TICKET using (NUMERO_IMMATRICULATION)
left outer join PLACE using (ID_PLACE)
left outer join PARKING using(ID_PARKING)
EXCEPT
select NUMERO_IMMATRICULATION
from VEHICULE 
left outer join TICKET using (NUMERO_IMMATRICULATION)
left outer join PLACE using (ID_PLACE)
left outer join PARKING using(ID_PARKING)
where DATE_TICKET = NOW()::date and HEURE_SORTIE > NOW()::time;

-- Liste de voitures et leur parking
select NUMERO_IMMATRICULATION, NOM_PARKING as PARKING_ACTUEL
from VEHICULE 
left outer join TICKET using (NUMERO_IMMATRICULATION)
left outer join PLACE using (ID_PLACE)
left outer join PARKING using(ID_PARKING)
where DATE_TICKET = NOW()::date and HEURE_SORTIE > NOW()::time
union all
select distinct on (NUMERO_IMMATRICULATION) NUMERO_IMMATRICULATION, Null as PARKING_ACTUEL
from VEHICULE 
left outer join TICKET using (NUMERO_IMMATRICULATION)
left outer join PLACE using (ID_PLACE)
left outer join PARKING using(ID_PARKING)
EXCEPT
select NUMERO_IMMATRICULATION, Null as PARKING_ACTUEL
from VEHICULE
left outer join TICKET using (NUMERO_IMMATRICULATION)
left outer join PLACE using (ID_PLACE)
left outer join PARKING using(ID_PARKING)
where DATE_TICKET = NOW()::date and HEURE_SORTIE > NOW()::time;