select avg(KILOMETRAGE) as moyenne_km
    from VEHICULE 
    where NUMERO_IMMATRICULATION in
        (select NUMERO_IMMATRICULATION 
            from TICKET group by NUMERO_IMMATRICULATION
            having count(ID_TICKET) = 
                (select max(ct) 
                    from (select count(*) as ct from TICKET 
                    group by NUMERO_IMMATRICULATION) as subquery));