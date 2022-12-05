SELECT max(ID_COMMUNE)
from COMMUNE;

create or replace INSERT_COMMUNE
before insert on COMMUNE
for each row
when (new.ID_COMMUNE < (
    SELECT max(ID_COMMUNE)
    from COMMUNE;
))
begin 
    update COMMUNE
    set ID_COMMUNE = (
    SELECT max(ID_COMMUNE)
    from COMMUNE;
    ) + 1 
    from COMMUNE
end;
/
show errors trigger INSERT_COMMUNE;
