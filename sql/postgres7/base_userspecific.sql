------------------------------------------------------------------
-- My2Pg 1.32 translated dump
--
------------------------------------------------------------------

BEGIN;




--
-- Sequences for table SRBASE_USERS_ACCOUNTS
--

CREATE SEQUENCE srbase_users_accounts_login_;

-- phpMyAdmin SQL Dump
-- version 2.5.3-rc2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2004 at 08:26 PM
-- Server version: 4.0.14
-- PHP Version: 4.3.3
-- 
-- Database : shadows
-- 

-- --------------------------------------------------------

--
-- Table structure for table srbase_users_accounts
--


CREATE TABLE "srbase_users_accounts" (
  "login_id" INT4 DEFAULT nextval('srbase_users_accounts_login_'),
  "login_name" varchar(30) DEFAULT '',
  "passwd" varchar(45) DEFAULT '',
  "auth" INT4 NOT NULL DEFAULT '0',
  "first_name" varchar(30) DEFAULT '',
  "last_name" varchar(30) DEFAULT '',
  "email_address" varchar(40) DEFAULT '',
  "icq" INT4 NOT NULL DEFAULT '0',
  "aim" varchar(50) DEFAULT '',
  "msn" varchar(50) DEFAULT '',
  "yim" varchar(50) DEFAULT '',
  "signed_up" INT4 NOT NULL DEFAULT '0',
  "session_exp" INT4 NOT NULL DEFAULT '0',
  "session_id" INT4 NOT NULL DEFAULT '0',
  "last_login" INT4 NOT NULL DEFAULT '0',
  "login_count" INT4 NOT NULL DEFAULT '0',
  "last_ip" varchar(16) DEFAULT '',
  "num_games_joined" INT4 NOT NULL DEFAULT '0',
  "total_score" INT4 NOT NULL DEFAULT '0',
  "con_speed" INT2 NOT NULL DEFAULT '2',
  "default_color_scheme" INT2 NOT NULL DEFAULT '1',
  "country" varchar(150) DEFAULT '',
  "hear_from" varchar(150) DEFAULT '',
  "e_list" INT2 NOT NULL DEFAULT '1',
  "birth_date" INT4 NOT NULL DEFAULT '0',
  "sex" INT2 NOT NULL DEFAULT '0',
  "hint_question" TEXT DEFAULT '' NOT NULL,
  "hint_answer" TEXT DEFAULT '' NOT NULL,
  PRIMARY KEY ("login_id")
);

--
-- Dumping data for table srbase_users_accounts
--

INSERT INTO "srbase_users_accounts" VALUES (1, 'Admin', '76a2173be6393254e72ffa4d6df1030a', 0, 'The', 'Administrator', 'admin@fakemail.com', 0, '', '', '', 1084986985, 1091820346, 8672, 1091819104, 112, '127.0.0.1', 0, 0, 2, 1, 'ie', '', 1, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table srbase_users_permissions
--


CREATE TABLE "srbase_users_permissions" (
  "login_id" INT4  NOT NULL DEFAULT '0',
  "login_name" varchar(32) DEFAULT '',
  "admin" INT2  NOT NULL DEFAULT '0',
  "deity" INT2  NOT NULL DEFAULT '0',
  "developer" INT2  NOT NULL DEFAULT '0',
  "moderator" INT2  NOT NULL DEFAULT '0',
  PRIMARY KEY ("login_id"),
  CHECK ("login_id">=0),
  CHECK ("admin">=0),
  CHECK ("deity">=0),
  CHECK ("developer">=0),
  CHECK ("moderator">=0)

);

--
-- Dumping data for table srbase_users_permissions
--

INSERT INTO "srbase_users_permissions" VALUES (1, 'Admin', 1, 1, 0, 0);

--
-- Indexes for table SRBASE_USERS_ACCOUNTS
--

CREATE UNIQUE INDEX login_name_srbase_users_accounts_index ON "srbase_users_accounts" ("login_name");
CREATE UNIQUE INDEX email_address_srbase_users_accounts_index ON "srbase_users_accounts" ("email_address");

--
-- Indexes for table SRBASE_USERS_PERMISSIONS
--

CREATE UNIQUE INDEX login_name_srbase_users_permissions_index ON "srbase_users_permissions" ("login_name");

--
-- Sequences for table SRBASE_USERS_ACCOUNTS
--

SELECT SETVAL('srbase_users_accounts_login_',(select case when max("login_id")>0 then max("login_id")+1 else 1 end from "srbase_users_accounts"));

COMMIT;
