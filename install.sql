CREATE TABLE admin (
    `uid` INT(10) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(20) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`uid`)
);

CREATE TABLE post (
    `pid` INT(10) NOT NULL AUTO_INCREMENT,
    `uid` INT(10) NOT NULL,
    `publish_time` INT(10) NOT NULL,
    `order` INT(10) NOT NULL DEFAULT 0,
    `title` VARCHAR(255) NOT NULL,
    `cid` INT(5) NOT NULL,
    `content` TEXT NOT NULL,
    PRIMARY KEY (`pid`)
);

CREATE TABLE channel (
    `cid` INT(5) NOT NULL AUTO_INCREMENT,
    `order` INT(10) NOT NULL DEFAULT 0,
    `name` VARCHAR(255) NOT NULL DEFAULT '',
    PRIMARY KEY (`cid`)
);
