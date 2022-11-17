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

-- Liste des parkings saturés à un jour donnée

-- Liste de voitures s'étant garé dans deux parkings différents la même journée

select NUMERO_IMMATRICULATION, DATE_TICKET
from TICKET
group by NUMERO_IMMATRICULATION, DATE_TICKET having count(NUMERO_IMMATRICULATION) > 1 and count(DATE_TICKET)=2;

-- Nombre de places par parking

select NOM_PARKING, count(ID_PLACE)
from (PARKING left outer join PLACE using (ID_PARKING))
group by NOM_PARKING;