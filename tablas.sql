
CREATE TABLE IF NOT EXISTS `users` (
    `id`                INTEGER(10)     NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(30)     NOT NULL,
    `surname`           VARCHAR(60)     NOT NULL,
    `gender`            VARCHAR(6)      NOT NULL,
    `email`             VARCHAR(60)     NOT NULL UNIQUE,
    `password`          VARCHAR(50)     NOT NULL,
    `birthdate`         DATE            NOT NULL,
    `city`              VARCHAR(50)     NOT NULL,
    `country`           VARCHAR(30)     NOT NULL,
    `favouritesport`    VARCHAR(150)    NOT NULL,
    `salt`              VARCHAR(50)     NOT NULL,
    PRIMARY KEY(`id`)
) AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `events` (
    `id`                INTEGER(10)     NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(120)    NOT NULL,
    `description`       VARCHAR(5000)   NOT NULL,
    `photo`             VARCHAR(500),
    `address`           VARCHAR(150)    NOT NULL,
    `city`              VARCHAR(50)     NOT NULL,
    `sport`             VARCHAR(20)     NOT NULL,
    `price`             FLOAT(5,2)      NOT NULL,
    `maxmembers`        INTEGER(3)      NOT NULL,
    `creatorid`         INTEGER(10)     NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`creatorid`) REFERENCES users(`id`) ON DELETE CASCADE
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `userevents` (
    `eventid`           INTEGER(10)     NOT NULL,
    `userid`            INTEGER(10)     NOT NULL,
    PRIMARY KEY(`eventid`,`userid`),
    FOREIGN KEY(`eventid`) REFERENCES events(`id`) ON DELETE CASCADE,
    FOREIGN KEY(`userid`) REFERENCES users(`id`) ON DELETE CASCADE
) DEFAULT CHARSET=utf8;
