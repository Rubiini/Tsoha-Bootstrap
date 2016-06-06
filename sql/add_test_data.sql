-- Lisää INSERT INTO lauseet tähän tiedostoon
insert into customer (username, password) values ('user', 'user');
insert into notes (title, date_, time_, place, status, priority, note, customer) values ('HelloWorld', '2016-05-30', '23:55', 'Helsinki', 'In proggress', '&#9733&#9733&#9733&#9733&#9733', 'hey', 1);
insert into classification (title, customer) values ('task', 1);
insert into classifications (notes, classification) values (1, 1);
