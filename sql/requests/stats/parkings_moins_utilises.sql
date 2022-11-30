select NOM_PARKING, count(ID_TICKET) as NOMBRE_TICKET
from PARKING
left outer join PLACE using(ID_PARKING)
left outer join TICKET using(ID_PLACE)
group by ID_PARKING
order by count(ID_TICKET) asc;