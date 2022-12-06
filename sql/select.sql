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



-- ============================================================
--    Statistiques
-- ============================================================

-- Moyenne du nombre de places dispo sur les parkings
-- actuellement 
-- a finir

select avg(dispo) as moyenne_dispo from

(select ID_PARKING, count(ID_PLACE) as dispo
    from PARKING natural join PLACE
    where ID_PLACE not in (
        select ID_PLACE from TICKET
        where DATE_TICKET=NOW()::date
                and (CURRENT_TIME between HEURE_ENTREE and HEURE_SORTIE))
    group by ID_PARKING) as subquery;



    

--insert into TICKET values (21, NOW(), CURRENT_TIME, CURRENT_TIME+ interval '1 hour', 'AO-365-HD',203);
    

-- la duree moyenne de stationnement d'un vehicule par parking
-- explication: pour 1 voiture donnee, moyenne du temps
-- de stationnement pour chaque parking

-- (requete imbriquee) donne le parking et le temps de stationnement pour chaque ticket
select ID_PARKING, (HEURE_SORTIE-HEURE_ENTREE) as DUREE 
    from TICKET inner join PLACE using(ID_PLACE);


-- requete finale OK
select ID_PARKING, avg(DUREE)
from (select ID_PARKING, (HEURE_SORTIE-HEURE_ENTREE) as DUREE 
    from PLACE 
    left outer join TICKET using(ID_PLACE)
    left outer join VEHICULE using(NUMERO_IMMATRICULATION) 
    where NUMERO_IMMATRICULATION = 'YK-966-AH' or ID_TICKET is null) as SUBQUERY
    group by ID_PARKING;








-- le cout moyen du stationnement d'un véhicule par mois,
-- explication: pour un vehicule donne, moyenne du coup des tickets
-- pour chaque mois

-- convertit le format hh:mm:ss en heures
select HEURE_ENTREE, (date_part('hour', HEURE_ENTREE) + date_part('minute', HEURE_ENTREE)/60 + date_part('second', HEURE_ENTREE)/3600) as TEMPS from TICKET;

-- prix paye pour chaque ticket
select DATE_TICKET, NUMERO_IMMATRICULATION, ID_COMMUNE, (TARIF_HORAIRE*(date_part('hour', HEURE_SORTIE-HEURE_ENTREE) + date_part('minute', HEURE_SORTIE-HEURE_ENTREE)/60 + date_part('second', HEURE_SORTIE-HEURE_ENTREE)/3600)) as COUT
    from TICKET 
    inner join PLACE using(ID_PLACE) 
        inner join PARKING using(ID_PARKING);


-- requete finale OK
select date_part('month',DATE_TICKET) as mois, date_part('year',DATE_TICKET) as annee, avg(COUT) as moyenne_cout_des_tickets
from (select DATE_TICKET, TARIF_HORAIRE*(date_part('hour', HEURE_SORTIE-HEURE_ENTREE) + date_part('minute', HEURE_SORTIE-HEURE_ENTREE)/60 + date_part('second', HEURE_SORTIE-HEURE_ENTREE)/3600) as COUT
    from PARKING
    left outer join PLACE using (ID_PARKING)
    left outer join TICKET using(ID_PLACE)
    left outer join VEHICULE using(NUMERO_IMMATRICULATION) 
    where NUMERO_IMMATRICULATION = 'YK-966-AH' or ID_TICKET is null) as SUBQUERY
    group by mois, annee;









-- classement des parkings les moins utilisés
select NOM_PARKING, count(ID_TICKET) as NOMBRE_TICKET
from PARKING
left outer join PLACE using(ID_PARKING)
left outer join TICKET using(ID_PLACE)
group by ID_PARKING
order by count(ID_TICKET) asc;








-- les parkings les plus rentables par commune et par mois
-- explication: pour une commune et un mois donnes, 
-- classement des parkings de cette commune qui ont genere le plus d'argent
select ID_PARKING, NOM_PARKING, coalesce(sum(TARIF_HORAIRE*(date_part('hour', HEURE_SORTIE-HEURE_ENTREE) + date_part('minute', HEURE_SORTIE-HEURE_ENTREE)/60 + date_part('second', HEURE_SORTIE-HEURE_ENTREE)/3600)),0) as CHIFFRE_DAFFAIRE
    from PARKING  
    left outer join PLACE using(ID_PARKING) 
    left outer join TICKET using (ID_PLACE)
    where (date_part('month',DATE_TICKET)=11 and date_part('year',DATE_TICKET)=2020) or ID_TICKET is null
    group by(ID_PARKING, NOM_PARKING)
    having ID_COMMUNE=2
    order by CHIFFRE_DAFFAIRE desc;








-- les communes les plus demandées
select NOM_COMMUNE, NOMBRE_TICKET
from COMMUNE
join ( select NOM_PARKING, ID_COMMUNE, count(ID_TICKET) as NOMBRE_TICKET
from PARKING
natural join PLACE
natural join TICKET
group by ID_PARKING
order by count(ID_TICKET) asc ) UTILISATION on UTILISATION.ID_COMMUNE = COMMUNE.ID_COMMUNE
order by NOMBRE_TICKET desc;








-- les communes les plus demandées par semaine
-- explication: pour une semaine donnée, donne le classement des communes ayant généré le plus de tickets au cours de la semaine

-- requete finale

select ID_COMMUNE, NOM_COMMUNE, count(ID_TICKET) as nb_tickets
from COMMUNE
left outer join PARKING using(ID_COMMUNE)
left outer join PLACE using(ID_PARKING)
left outer join TICKET using(ID_PLACE)
where (DATE_TICKET between '2020-12-30' and '2021-01-07') or ID_TICKET is null
group by ID_COMMUNE, NOM_COMMUNE
order by nb_tickets desc;






-- moyenne des kilométrages des voitures ayant le plus de tickets
-- explication: filtre les vehicules pour ne garder que ceux ayant un nombre de ticket egal a max
-- puis effectue la moyenne sur leurs kilometrages
select avg(KILOMETRAGE) as moyenne_km
    from VEHICULE 
    where NUMERO_IMMATRICULATION in
        (select NUMERO_IMMATRICULATION 
            from TICKET group by NUMERO_IMMATRICULATION
            having count(ID_TICKET) = 
                (select max(ct) 
                    from (select count(*) as ct from TICKET 
                    group by NUMERO_IMMATRICULATION) as subquery));
