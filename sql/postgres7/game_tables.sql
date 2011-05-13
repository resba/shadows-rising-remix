------------------------------------------------------------------
-- My2Pg 1.32 translated dump
--
------------------------------------------------------------------

BEGIN;




--
-- Sequences for table SRBASE_SRMODULE_SRRPG_BACKPACK
--

CREATE SEQUENCE srbase_srmodule_srrpg_backpa;

-- phpMyAdmin SQL Dump
-- version 2.5.3-rc2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2004 at 08:33 PM
-- Server version: 4.0.14
-- PHP Version: 4.3.3
-- 
-- Database : shadows
-- 

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_srrpg_backpack
--


CREATE TABLE "srbase_srmodule_srrpg_backpack" (
  "pack_id" INT4 DEFAULT nextval('srbase_srmodule_srrpg_backpa'),
  "login_id" INT4  NOT NULL DEFAULT '0',
  "item_id" INT4  NOT NULL DEFAULT '0',
  "item_name" varchar(64) DEFAULT 'Unidentified',
  "type" varchar(32) DEFAULT 'Unknown',
  "level" INT2  NOT NULL DEFAULT '0',
  "weight" INT2  NOT NULL DEFAULT '0',
  "handle" varchar(32) DEFAULT 'single',
  "equipped" INT2  NOT NULL DEFAULT '0',
  "position" varchar(32) DEFAULT 'backpack',
  "cost" INT4  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_srrpg_backpack
--

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_srrpg_characters
--


CREATE TABLE "srbase_srmodule_srrpg_characters" (
  "login_id" INT4  NOT NULL DEFAULT '0',
  "login_name" varchar(64) DEFAULT '',
  "name" varchar(64) DEFAULT '',
  "race_id" INT4  NOT NULL DEFAULT '0',
  "race_name" varchar(64) DEFAULT 'human',
  "sex" varchar(6) DEFAULT 'male',
  "class_id" INT4  NOT NULL DEFAULT '0',
  "class_name" varchar(64) DEFAULT '',
  "rank" INT4  NOT NULL DEFAULT '0',
  "rank_name" varchar(32) DEFAULT '',
  "hp" INT4  NOT NULL DEFAULT '10',
  "level" INT4  NOT NULL DEFAULT '1',
  "exp" INT4  NOT NULL DEFAULT '0',
  "gold" INT4  NOT NULL DEFAULT '100',
  "gems" INT4  NOT NULL DEFAULT '0',
  "str" INT4  NOT NULL DEFAULT '10',
  "dex" INT4  NOT NULL DEFAULT '10',
  "con" INT4  NOT NULL DEFAULT '10',
  "intel" INT4  NOT NULL DEFAULT '10',
  "wis" INT4  NOT NULL DEFAULT '10',
  "cha" INT4  NOT NULL DEFAULT '10',
  "char_check" INT2  NOT NULL DEFAULT '0',
  "location" INT4  NOT NULL DEFAULT '0',
  "modifiers" text,
  "curr_template_page" varchar(128) DEFAULT '',
  "curr_template_vars" TEXT DEFAULT '' NOT NULL,
  "curr_request_uri" varchar(128) DEFAULT '',
  "curr_allowed_navs" TEXT DEFAULT '' NOT NULL
);

--
-- Dumping data for table srbase_srmodule_srrpg_characters
--

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_srrpg_locations
--




--
-- Sequences for table SRBASE_SRMODULE_SRRPG_LOCATIONS
--

CREATE SEQUENCE srbase_srmodule_srrpg_locati;

CREATE TABLE "srbase_srmodule_srrpg_locations" (
  "loc_id" INT4 DEFAULT nextval('srbase_srmodule_srrpg_locati'),
  "mp_name" varchar(32) DEFAULT 'unnamed',
  "x_loc" INT2  NOT NULL DEFAULT '0',
  "y_loc" INT2  NOT NULL DEFAULT '0',
  "terrain_img" varchar(32) DEFAULT 'no_terrain.gif',
  "nlink" varchar(16) DEFAULT '',
  "elink" varchar(16) DEFAULT '',
  "slink" varchar(16) DEFAULT '',
  "wlink" varchar(16) DEFAULT '',
  "linked" INT2  NOT NULL DEFAULT '0',
  "gamestart" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_srrpg_locations
--

INSERT INTO "srbase_srmodule_srrpg_locations" VALUES (1, 'default', 1, 10, 'grass_0.gif', '', '', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_srrpg_merchants
--


CREATE TABLE "srbase_srmodule_srrpg_merchants" (
  "shop_id" INT4  NOT NULL DEFAULT '0',
  "location" INT4  NOT NULL DEFAULT '0',
  "item_type" varchar(32) DEFAULT 'weapon',
  "name" varchar(64) DEFAULT 'Suspiciously Anonymous Shop'
);

--
-- Dumping data for table srbase_srmodule_srrpg_merchants
--

INSERT INTO "srbase_srmodule_srrpg_merchants" VALUES (1, 1, 'weapon', 'Maugrim\'s Weaponry Superstore');




--
-- Table structure for table srbase_srmodule_srrpg_forums
--




--
-- Sequences for table SRBASE_SRMODULE_SRRPG_FORUMS
--

CREATE SEQUENCE srmodule_srrpg_forums;

CREATE TABLE "srbase_srmodule_srrpg_forums" (
  "forum_id" INT4 DEFAULT nextval('srmodule_srrpg_forums'),
  "cat" INT4 NOT NULL DEFAULT '0',
  "name" varchar(25) DEFAULT '',
  "description" varchar(255) DEFAULT '',
  "location" INT4 NOT NULL DEFAULT '0'
);

INSERT INTO "srbase_srmodule_srrpg_forums" VALUES (1, 0, 'Test Forum', 'A test forum', 1);

--
-- "Table" structure for table srbase_srmodule_srrpg_topics
--



--
-- Sequences for table SRBASE_SRMODULE_SRRPG_TOPICS
--

CREATE SEQUENCE srmodule_srrpg_topics;

CREATE TABLE "srbase_srmodule_srrpg_topics" (
  "topic_id" INT4 DEFAULT nextval('srmodule_srrpg_topics'),
  "forum" INT4 NOT NULL DEFAULT '0',
  "name" varchar(11) DEFAULT '',
  "starter" INT4 NOT NULL DEFAULT '0',
  "lastpost" INT4 NOT NULL DEFAULT '0', 
  "poll" INT4 NOT NULL DEFAULT '0'
);

INSERT INTO "srbase_srmodule_srrpg_topics" VALUES (1, 1, 'Test Topic', 1, 0, 0);

--
-- "Table" structure for table srbase_srmodule_srrpg_posts
--




--
-- Sequences for table SRBASE_SRMODULE_SRRPG_POSTS
--

CREATE SEQUENCE srbase_srmodule_srrpg_posts_;

CREATE TABLE "srbase_srmodule_srrpg_posts" (
  "post_id" INT4 DEFAULT nextval('srbase_srmodule_srrpg_posts_'),
  "topic" INT4 NOT NULL DEFAULT '0',
  "time" varchar(25) DEFAULT '',
  "title" varchar(25) DEFAULT '',
  "poster" INT4 NOT NULL DEFAULT '0',
  "message" TEXT DEFAULT '' NOT NULL
);

INSERT INTO "srbase_srmodule_srrpg_posts" VALUES (1, 1, '555496413', 'Test Post', 1, 'This is a test post'); 
INSERT INTO "srbase_srmodule_srrpg_posts" VALUES (2, 1, '555496500', '', 1, 'Bump');

--
-- "Table" structure for table srbase_srmodule_srrpg_poll
--
-- "NOT" SUPPORTED YET

--
-- "Table" structure for table srbase_srmodule_srrpg_poll_options
--
-- "NOT" SUPPORTED YET

--
-- "Table" structure for table srbase_srmodule_srrpg_poll_votes
--
-- "NOT" SUPPORTED YET

--
-- "Table" structure for table srbase_srmodule_srrpg_bans
--
-- "NOT" SUPPORTED YET

--
-- "Table" structure for table srbase_srmodule_srrpg_moderators
--
-- "NOT" SUPPORTED YET

--
-- Indexes for table SRBASE_SRMODULE_SRRPG_BACKPACK
--

CREATE UNIQUE INDEX pack_id_srbase_srmodule_srrpg_backpack_index ON "srbase_srmodule_srrpg_backpack" ("pack_id");

--
-- Indexes for table SRBASE_SRMODULE_SRRPG_CHARACTERS
--

CREATE UNIQUE INDEX login_id_srbase_srmodule_srrpg_characters_index ON "srbase_srmodule_srrpg_characters" ("login_id","login_name");

--
-- Indexes for table SRBASE_SRMODULE_SRRPG_LOCATIONS
--

CREATE UNIQUE INDEX tile_id_srbase_srmodule_srrpg_locations_index ON "srbase_srmodule_srrpg_locations" ("loc_id");

--
-- Sequences for table SRBASE_SRMODULE_SRRPG_POSTS
--

SELECT SETVAL('srbase_srmodule_srrpg_posts_',(select case when max("post_id")>0 then max("post_id")+1 else 1 end from "srbase_srmodule_srrpg_posts"));

--
-- Sequences for table SRBASE_SRMODULE_SRRPG_BACKPACK
--

SELECT SETVAL('srbase_srmodule_srrpg_backpa',(select case when max("pack_id")>0 then max("pack_id")+1 else 1 end from "srbase_srmodule_srrpg_backpack"));

--
-- Sequences for table SRBASE_SRMODULE_SRRPG_TOPICS
--

SELECT SETVAL('srmodule_srrpg_topics',(select case when max("topic_id")>0 then max("topic_id")+1 else 1 end from "srbase_srmodule_srrpg_topics"));

--
-- Sequences for table SRBASE_SRMODULE_SRRPG_LOCATIONS
--

SELECT SETVAL('srbase_srmodule_srrpg_locati',(select case when max("loc_id")>0 then max("loc_id")+1 else 1 end from "srbase_srmodule_srrpg_locations"));

--
-- Sequences for table SRBASE_SRMODULE_SRRPG_FORUMS
--

SELECT SETVAL('srmodule_srrpg_forums',(select case when max("forum_id")>0 then max("forum_id")+1 else 1 end from "srbase_srmodule_srrpg_forums"));

COMMIT;
