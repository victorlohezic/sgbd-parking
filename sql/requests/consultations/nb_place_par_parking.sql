-- Nombre de places par parking

select NOM_PARKING, count(ID_PLACE)
from (PARKING left outer join PLACE using (ID_PARKING))
group by NOM_PARKING;