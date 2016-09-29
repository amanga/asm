CREATE DATABASE ASM_WORKSPACE;

CREATE TABLE TOPICS (
TOPIC_ID varchar(32) NOT NULL PRIMARY KEY,
TITLE varchar(1024) NOT NULL,
THUMBNAIL varchar(512) NOT NULL,
IMAGEURL varchar(512) NOT NULL,
CREATED_ON timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
CREATED_BY varchar(32) DEFAULT '{system}' NOT NULL,
LASTMODIFIED_ON timestamp NOT NULL,
LASTMODIFIED_BY varchar(32) DEFAULT '{system}' NOT NULL,
PARAMS bigint  DEFAULT 0 NOT NULL,
STATUS tinyint DEFAULT 1 NOT NULL,
REMOVED bit DEFAULT 0 NOT NULL,
DESCRIPTION varchar(2048) NOT NULL
);

CREATE TABLE TOPICUNITS (
PARENTTOPIC_ID varchar(32) NOT NULL ,FOREIGN KEY (PARENTTOPIC_ID) REFERENCES TOPICS(TOPIC_ID),
CHILDTOPIC_ID varchar(32) NOT NULL ,FOREIGN KEY (CHILDTOPIC_ID) REFERENCES TOPICS(TOPIC_ID),
CREATED_ON timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
CREATED_BY varchar(32) DEFAULT '{system}' NOT NULL,
LASTMODIFIED_ON timestamp NOT NULL,
LASTMODIFIED_BY varchar(32) DEFAULT '{system}' NOT NULL,
PARAMS bigint  DEFAULT 0 NOT NULL,
STATUS tinyint DEFAULT 1 NOT NULL,
REMOVED bit DEFAULT 0 NOT NULL,
DESCRIPTION varchar(2048) NOT NULL
);


