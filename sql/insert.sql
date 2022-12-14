-- ============================================================
--    creation des donnees
-- ============================================================

-- COMMUNE

insert into COMMUNE values (1, 'Lorient', '56100');
insert into COMMUNE values (2, 'Bordeaux', '33000');
insert into COMMUNE values (3, 'Pessac', '33600');
insert into COMMUNE values (4, 'Talence', '33400');
insert into COMMUNE values (5, 'Pau', '64000');
insert into COMMUNE values (6, 'Nimes', '30000');



-- VEHICULE 

insert into VEHICULE values ('MF-246-QA','Peugeot', '2014-06-09', 20000, 'bon');
insert into VEHICULE values ('DI-164-GD', 'Alfa Romeo', '2015-10-12', 45799, 'bon');
insert into VEHICULE values ('OL-758-JV', 'Fiat', '2016-11-15', 20673, 'bon');
insert into VEHICULE values ('JD-852-MD', 'Bugatti', '2022-11-13', 14, 'mauvais');
insert into VEHICULE values ('AP-445-YJ', 'Peugeot', '2014-06-25', 30000, 'bon');
insert into VEHICULE values ('PC-967-DK', 'Peugeot', '2021-03-16', 200, 'presque neuf');
insert into VEHICULE values ('SH-125-FV', 'Ford', '2020-06-12', 500, 'preque neuf');
insert into VEHICULE values ('AO-365-HD', 'Ford', '2001-02-18', 100000, 'mauvais');
insert into VEHICULE values ('YK-966-AH', 'Fiat', '2001-12-26', 50000, 'mauvais');
insert into VEHICULE values ('PD-158-JK', 'Peugeot', '1999-07-05', 250000, 'mauvais');
insert into VEHICULE values ('ZT-756-PA', 'Fiat', '2007-06-21', 90000, 'mauvais');


-- PARKING

insert into PARKING values (1, 'Village 1', '12 Av. de Collegno', 22, 1);
insert into PARKING values (2, 'Village 2', '7 Av. Pey Berland', 5, 2);
insert into PARKING values (3, 'Village 3', '9 Esp. des Antilles', 22, 3);
insert into PARKING values (4, 'Quaie de Brienne', '10 Qu. de Brienne', 20, 2);
insert into PARKING values (5, 'Capucins', 'Marché des Capucins', 5, 2);
insert into PARKING values (6, 'Peixotto', '10 All. Peixotto', 20, 3);


-- PLACE

insert into PLACE values (101, 1, 1);
insert into PLACE values (102, 2, 1);
insert into PLACE values (103, 3, 1);
insert into PLACE values (104, 4, 1);
insert into PLACE values (105, 5, 1);

insert into PLACE values (201, 1, 2);
insert into PLACE values (202, 2, 2);
insert into PLACE values (203, 3, 2);
insert into PLACE values (204, 4, 2);
insert into PLACE values (205, 5, 2);

insert into PLACE values (301, 1, 3);
insert into PLACE values (302, 2, 3);
insert into PLACE values (303, 3, 3);
insert into PLACE values (304, 4, 3);
insert into PLACE values (305, 5, 3);

insert into PLACE values (401, 1, 4);
insert into PLACE values (402, 2, 4);
insert into PLACE values (403, 3, 4);
insert into PLACE values (404, 4, 4);
insert into PLACE values (405, 5, 4);

insert into PLACE values (501, 1, 5);
insert into PLACE values (502, 2, 5);
insert into PLACE values (503, 3, 5);
insert into PLACE values (504, 4, 5);
insert into PLACE values (505, 5, 5);


insert into PLACE values (601, 1, 6);
insert into PLACE values (602, 2, 6);
insert into PLACE values (603, 3, 6);
insert into PLACE values (604, 4, 6);
insert into PLACE values (605, 5, 6);




-- TICKET
insert into TICKET values (1, '2021-03-07', '14:09:48','18:23:27', 'YK-966-AH',104);
insert into TICKET values (2, '2020-11-11', '07:51:13','14:44:27', 'OL-758-JV',202);
insert into TICKET values (3, '2022-08-02', '16:42:45','19:26:27', 'PC-967-DK',205);
insert into TICKET values (4, '2020-12-30', '09:13:27','17:49:27', 'ZT-756-PA',301);
insert into TICKET values (5, '2022-04-14', '08:56:56','12:18:27', 'YK-966-AH',103);
insert into TICKET values (6, '2021-09-19', '12:32:38','15:31:27', 'AO-365-HD',104);
insert into TICKET values (7, '2022-04-14', '15:54:32','18:10:29', 'YK-966-AH',303);
insert into TICKET values (8, '2022-09-19', '12:32:38','15:31:27', 'AO-365-HD',104);
insert into TICKET values (9, '2020-12-30', '18:13:27','19:49:27', 'ZT-756-PA',305);
insert into TICKET values (10, '2020-12-30', '20:13:27','21:49:27', 'ZT-756-PA',303);
insert into TICKET values (11, '2021-03-07', '17:09:42','18:23:58', 'YK-966-AH',105);
insert into TICKET values (12, '2020-11-11', '09:33:13','14:44:55', 'YK-966-AH',402);
insert into TICKET values (13, '2022-09-02', '16:02:45','19:26:05', 'YK-966-AH',505);
insert into TICKET values (14, '2020-12-30', '09:03:59','17:49:20', 'ZT-756-PA',401);
insert into TICKET values (15, '2022-04-14', '22:22:56','23:18:55', 'ZT-756-PA',101);
insert into TICKET values (16, '2021-09-19', '14:32:30','15:31:21', 'ZT-756-PA',404);
insert into TICKET values (17, '2022-04-14', '14:54:32','18:10:39', 'AO-365-HD',503);
insert into TICKET values (18, '2022-09-19', '12:39:47','15:30:27', 'YK-966-AH',504);
insert into TICKET values (19, '2020-12-30', '18:11:11','19:35:27', 'AO-365-HD',405);
insert into TICKET values (20, '2020-12-30', '21:19:27','21:44:27', 'AO-365-HD',203);
--insert into TICKET values (22, '2020-11-11', '09:33:13','14:44:55', 'AO-365-HD',504);

insert into TICKET values (21, NOW(), CURRENT_TIME, CURRENT_TIME+ interval '1 hour', 'AO-365-HD',203);
