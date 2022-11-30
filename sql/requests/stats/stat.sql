-- ============================================================
--    Statistiques
-- ============================================================

-- Moyenne du nombre de places sur les parkings

select avg(count)
from (select NOM_PARKING, count(ID_PLACE)
    from (PARKING left outer join PLACE using (ID_PARKING))
    group by NOM_PARKING) as SUBQUERY;

-- la duree moyenne de stationnement d'un vehicule par parking
-- (requete imbriquee) donne le parking et le temps de stationnement pour chaque ticket
select ID_PARKING, (HEURE_SORTIE-HEURE_ENTREE) as DUREE 
    from TICKET inner join PLACE using(ID_PLACE);

select ID_PARKING, avg(DUREE)
from (select ID_PARKING, (HEURE_SORTIE-HEURE_ENTREE) as DUREE 
    from TICKET inner join PLACE using(ID_PLACE)) as SUBQUERY
    group by ID_PARKING;


-- le cout moyen du stationnement d'un véhicule par mois,

-- convertit le format hh:mm:ss en heures
select HEURE_ENTREE, (date_part('hour', HEURE_ENTREE) + date_part('minute', HEURE_ENTREE)/60 + date_part('second', HEURE_ENTREE)/3600) as TEMPS from TICKET;

-- prix paye pour chaque ticket

select DATE_TICKET, (TARIF_HORAIRE*(date_part('hour', HEURE_SORTIE-HEURE_ENTREE) + date_part('minute', HEURE_SORTIE-HEURE_ENTREE)/60 + date_part('second', HEURE_SORTIE-HEURE_ENTREE)/3600)) as COUT
    from TICKET 
    inner join PLACE using(ID_PLACE) 
        inner join PARKING using(ID_PARKING);

-- les parkings les moins utilisés
select NOM_PARKING, count(ID_TICKET) as NOMBRE_TICKET
from PARKING
natural join PLACE
natural join TICKET
group by ID_PARKING
order by count(ID_TICKET) asc;

-- les parkings les plus rentables par commune et par mois

-- select NOM_PARKING, NOM_COMMUNE
-- from PARKING
-- natural join PLACE
-- natural join TICKET
-- natural join COMMUNE

-- group by NOM_COMMUNE

-- les communes les plus demandées par semaine

select NOM_COMMUNE, NOMBRE_TICKET
from COMMUNE
join ( select NOM_PARKING, ID_COMMUNE, count(ID_TICKET) as NOMBRE_TICKET
from PARKING
natural join PLACE
natural join TICKET
group by ID_PARKING
order by count(ID_TICKET) asc ) UTILISATION on UTILISATION.ID_COMMUNE = COMMUNE.ID_COMMUNE
order by NOMBRE_TICKET desc;