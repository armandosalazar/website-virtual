show databases;

create database social_commerces;

use social_commerces;

create table users (
	`id` int unsigned not null auto_increment primary key,
    `name` varchar(255) not null,
    `last_name` varchar(255) not null,
    `email` varchar(255) not null,
    `password` varchar(255) not null
);

create table products (
	`id` int unsigned not null auto_increment,
    `id_user` int unsigned not null,
    `name` varchar(255) not null,
    `description` varchar(255) not null,
    `price` double not null,
    `stock` int not null,
    `image` varchar(255) not null,
    primary key (`id`),
    foreign key (`id_user`) references users(`id`)
);

create table shopping (
	`id` int unsigned not null auto_increment primary key,
    `id_user` int unsigned not null,
    `id_product` int unsigned not null,
    foreign key (`id_user`) references `users`(`id`),
    foreign key (`id_product`) references products(`id`)
);

select p.* from products p inner join shopping s on p.id = s.id_product where s.id_user = 1;

create table reports (
    `id` int unsigned not null auto_increment primary key,
    `id_user` int unsigned not null,
    `url` varchar(255) not null,
    foreign key (`id_user`) references users(`id`)
);