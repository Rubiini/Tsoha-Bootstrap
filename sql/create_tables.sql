-- Lisää CREATE TABLE lauseet tähän tiedostoon
create table customer(
	id serial primary key,
	username varchar(50) not null,
	password varchar(50) not null
);

create table notes(
	id serial primary key,
	title varchar(80) not null,
	date_ date,
        time_ time,
        place varchar(50),
        status varchar(20),
	priority varchar(30),
        note varchar(500),
        customer integer references customer(id)
);

create table classification(
	id serial primary key,
	title varchar(50),
	customer integer references customer(id)
);

create table classifications(
	notes integer references notes(id),
	classification integer references classification(id)
);

