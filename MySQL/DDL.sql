use elheraldo;

create table if not exists `users` (
  `oauth_provider` enum('','facebook','google','twitter') not null,
  `oauth_uid` varchar(100) not null,
  `first_name` varchar(50) not null,
  `last_name` varchar(50) not null,
  `email` varchar(100) not null,
  `gender` varchar(10) not null,
  `locale` varchar(10) not null,
  `picture` longtext not null,
  `link` varchar(255) not null,
  `ip` varchar(100) not null,
  `created` datetime not null,
  `modified` datetime not null,
  primary key (`oauth_uid`)
);

create table if not exists `foto` (
  `idfoto` varchar(100) not null,
  `oauth_uid` varchar(100) not null,
  `ruta` longtext not null,
  primary key (`idfoto`),
  index `fk_foto_users_idx` (`oauth_uid` asc),
  constraint `fk_foto_users`
    foreign key (`oauth_uid`)
    references `users` (`oauth_uid`));

-- -----------------------------------------------------
-- table `voto`
-- -----------------------------------------------------
create table if not exists `voto` (
  `idvoto` int NOT NULL AUTO_INCREMENT,
  `idfoto` varchar(100) not null,
  `id_usuario_voto` varchar(100) not null,
  primary key (`idvoto`),
  index `fk_voto_foto1_idx` (`idfoto` asc),
  constraint `fk_voto_foto1`
    foreign key (`idfoto`)
    references `foto` (`idfoto`));
