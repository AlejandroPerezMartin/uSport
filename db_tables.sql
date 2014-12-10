
-- Store information related to users
CREATE TABLE IF NOT EXISTS `users` (
    `id`                INTEGER(10)     NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(30)     NOT NULL,
    `surname`           VARCHAR(60)     NOT NULL,
    `gender`            VARCHAR(6)      NOT NULL,
    `email`             VARCHAR(60)     NOT NULL UNIQUE KEY,
    `password`          VARCHAR(50)     NOT NULL,
    `birthdate`         DATE            NOT NULL,
    `city`              VARCHAR(50)     NOT NULL,
    `country`           VARCHAR(30)     NOT NULL,
    `favouritesport`    VARCHAR(150)    NOT NULL,
    `premium`           TINYINT(1)      NOT NULL DEFAULT 0,
    `salt`              VARCHAR(50)     NOT NULL,
    PRIMARY KEY(`id`)
) AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Log Premium Membership payments
CREATE TABLE IF NOT EXISTS `premium` (
    `id`                INTEGER(10)     NOT NULL AUTO_INCREMENT,
    `userid`            INTEGER(10)     NOT NULL,
    `transactionid`     VARCHAR(125),
    `date`              DATE            NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`userid`) REFERENCES users(`id`) ON DELETE CASCADE
) DEFAULT CHARSET=utf8;

-- Store information related to events
CREATE TABLE IF NOT EXISTS `events` (
    `id`                INTEGER(10)     NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(120)    NOT NULL,
    `description`       VARCHAR(5000)   NOT NULL,
    `photo`             VARCHAR(500),
    `address`           VARCHAR(150)    NOT NULL,
    `date`              DATE            NOT NULL,
    `time`              VARCHAR(5)      NOT NULL,
    `city`              VARCHAR(50)     NOT NULL,
    `sport`             VARCHAR(20)     NOT NULL,
    `maxmembers`        INTEGER(3)      NOT NULL,
    `creatorid`         INTEGER(10)     NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`creatorid`) REFERENCES users(`id`) ON DELETE CASCADE
) DEFAULT CHARSET=utf8;

-- Users joined to the events
CREATE TABLE IF NOT EXISTS `userevents` (
    `eventid`           INTEGER(10)     NOT NULL,
    `userid`            INTEGER(10)     NOT NULL,
    PRIMARY KEY(`eventid`,`userid`),
    FOREIGN KEY(`eventid`) REFERENCES events(`id`) ON DELETE CASCADE,
    FOREIGN KEY(`userid`) REFERENCES users(`id`) ON DELETE CASCADE
) DEFAULT CHARSET=utf8;

-- Store information related to multimedia content (images, videos)
CREATE TABLE IF NOT EXISTS `media` (
    `id`                INTEGER         NOT NULL AUTO_INCREMENT,
    `filename`          VARCHAR(255)    NOT NULL,
    `title`             VARCHAR(100)    NOT NULL,
    PRIMARY KEY(`id`),
) DEFAULT CHARSET=utf8;
