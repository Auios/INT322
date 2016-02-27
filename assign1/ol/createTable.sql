create table phone (
id int zerofill not null auto_increment,
itemName varchar(40) not null,
price decimal(10,2) not null,
primary key (id)
);

create table tablet (
id int zerofill not null auto_increment,
itemName varchar(40) not null,
price decimal(10,2) not null,
primary key (id)
);

create table desktop (
id int zerofill not null auto_increment,
itemName varchar(40) not null,
price decimal(10,2) not null,
primary key (id)
);

create table laptop (
id int zerofill not null auto_increment,
itemName varchar(40) not null,
price decimal(10,2) not null,
primary key (id)
);

create table desktop (
id varchar(60) not null,
itemName varchar(40) not null,
price decimal(10,2) not null,
primary key (id)
);

create table android (
model varchar(60) not null,
os varchar(40) not null,
verssion varchar(40) not null,
price decimal(10,2) not null
);

create table Iphone (
model varchar(60) not null,
os varchar(40) not null,
verssion varchar(40) not null,
price decimal(10,2) not null
);

create table Microsoft (
model varchar(60) not null,
os varchar(40) not null,
verssion varchar(40) not null,
price decimal(10,2) not null
);

create table BlackBerry (
model varchar(60) not null,
os varchar(40) not null,
verssion varchar(40) not null,
price decimal(10,2) not null
);
