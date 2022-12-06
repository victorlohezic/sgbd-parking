-- ============================================================
--    Mise à jour
-- ============================================================

create or replace procedure rename(oldname VARCHAR, newname VARCHAR)
LANGUAGE plpgsql
as $$
begin
update PARKING
set NOM_PARKING=newname
where NOM_PARKING=oldname;
end
$$;

CALL rename('Village 1', 'Village 4'    );