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
    from TICKET inner join PLACE using(ID_PLACE)

-- requete finale
select ID_PARKING, avg(DUREE)
from (select ID_PARKING, (HEURE_SORTIE-HEURE_ENTREE) as DUREE 
    from TICKET inner join PLACE using(ID_PLACE)) as SUBQUERY
    group by ID_PARKING;


-- le cout moyen du stationnement d'un véhicule par mois,

-- convertit le format hh:mm:ss en heures
select HEURE_ENTREE, (date_part('hour', HEURE_ENTREE) + date_part('minute', HEURE_ENTREE)/60 + date_part('second', HEURE_ENTREE)/3600) from TICKET;

-- prix paye pour chaque ticket

select ID_PARKING, DATE_TICKET, (TARIF_HORAIRE*(date_part('hour', HEURE_SORTIE-HEURE_ENTREE) + date_part('minute', HEURE_SORTIE-HEURE_ENTREE)/60 + date_part('second', HEURE_SORTIE-HEURE_ENTREE)/3600)) as COUT
    from TICKET 
    inner join PLACE using(ID_PLACE) 
        inner join PARKING using(ID_PARKING)
        order by (DATE_TICKET);

-- requete finale

select date_part('month',DATE_TICKET) as MOIS, date_part('year', DATE_TICKET) as ANNEE, avg(TARIF_HORAIRE*(date_part('hour', HEURE_SORTIE-HEURE_ENTREE) + date_part('minute', HEURE_SORTIE-HEURE_ENTREE)/60 + date_part('second', HEURE_SORTIE-HEURE_ENTREE)/3600)) as COUT
      from TICKET 
      inner join PLACE using(ID_PLACE) 
      inner join PARKING using(ID_PARKING)
group by MOIS, ANNEE order by ANNEE, MOIS;



-- moyenne des kilométrages des voitures ayant le plus de tickets
select avg(KILOMETRAGE) as moyenne_km
    from VEHICULE 
    where NUMERO_IMMATRICULATION in
        (select NUMERO_IMMATRICULATION 
            from TICKET group by NUMERO_IMMATRICULATION
            having count(ID_TICKET) = 
                (select max(ct) 
                    from (select count(*) as ct from TICKET 
                    group by NUMERO_IMMATRICULATION) as subquery));



-- Classement des parkings qui génèrent le plus d'argent, avec ville et moyenne par mois
-- pas fini

select ID_PARKING,ID_COMMUNE, avg(TARIF_HORAIRE*(date_part('hour', HEURE_SORTIE-HEURE_ENTREE) + date_part('minute', HEURE_SORTIE-HEURE_ENTREE)/60 + date_part('second', HEURE_SORTIE-HEURE_ENTREE)/3600)) as Moyenne
    from TICKET 
    inner join PLACE using(ID_PLACE) 
        inner join PARKING using(ID_PARKING)
        group by (ID_PARKING, ID_COMMUNE);



select ID_PARKING, date_part('month',DATE_TICKET) as mois, date_part('year',DATE_TICKET) as annee, avg(TARIF_HORAIRE*(date_part('hour', HEURE_SORTIE-HEURE_ENTREE) + date_part('minute', HEURE_SORTIE-HEURE_ENTREE)/60 + date_part('second', HEURE_SORTIE-HEURE_ENTREE)/3600)) as COUT
    from TICKET 
    inner join PLACE using(ID_PLACE) 
        inner join PARKING using(ID_PARKING)
        group by (ID_PARKING, mois, annee);