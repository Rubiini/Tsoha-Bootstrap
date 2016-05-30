-- Lisää INSERT INTO lauseet tähän tiedostoon
insert into customer (username, password) values ('user', 'user');
insert into notes (customer, title, date_, time_, place, status, priority, note, customer) values ((select id from customer where username='user'), 'HelloWorld', '2016-05-30', '23:55', 'Helsinki', 'In proggress', '&#9733&#9733&#9733&#9733&#9733', 'hey');

