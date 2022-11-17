-- ============================================================
--    Statistiques
-- ============================================================

-- Moyenne du nombre de places sur les parkings

select avg(count)
from (select NOM_PARKING, count(*)
    from (PARKING inner join PLACE using (ID_PARKING))
    group by NOM_PARKING) as SUBQUERY;