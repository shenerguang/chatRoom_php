use phpMessage;

create table if not exists `users` (
 `id` int(30) NOT NULL,
 `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
 `pwd` varchar(30) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table if not exists `messageM` (
 `id` int(30) NOT NULL ,
 `content` varchar(3000) NOT NULL,
 `time` timestamp NOT NULL,
 PRIMARY KEY (`id`,`time`),
 CONSTRAINT `FK_USER_ID` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into users value(1,'zhangsan','123456');
