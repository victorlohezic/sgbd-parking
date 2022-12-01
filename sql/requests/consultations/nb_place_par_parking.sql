-- Nombre de places par parking

select NOM_PARKING, count(ID_PLACE) as PLACE_PAR_PARKING
from (PARKING left outer join PLACE using (ID_PARKING))
group by NOM_PARKING;