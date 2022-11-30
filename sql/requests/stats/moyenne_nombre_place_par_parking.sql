select avg(count)
from (select NOM_PARKING, count(ID_PLACE)
    from (PARKING left outer join PLACE using (ID_PARKING))
    group by NOM_PARKING) as SUBQUERY;