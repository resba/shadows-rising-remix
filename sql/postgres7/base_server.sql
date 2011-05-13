------------------------------------------------------------------
-- My2Pg 1.32 translated dump
--
------------------------------------------------------------------

BEGIN;




--
-- Sequences for table SRBASE_BLOCK_NEWS
--

CREATE SEQUENCE srbase_block_news_news_id_se;

-- phpMyAdmin SQL Dump
-- version 2.5.3-rc2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2004 at 08:28 PM
-- Server version: 4.0.14
-- PHP Version: 4.3.3
-- 
-- Database : shadows
-- 

-- --------------------------------------------------------

--
-- Table structure for table srbase_block_news
--


CREATE TABLE "srbase_block_news" (
  "news_id" INT4 DEFAULT nextval('srbase_block_news_news_id_se'),
  "login_id" INT4  NOT NULL DEFAULT '0',
  "login_name" varchar(128) DEFAULT 'Anonymous',
  "timestamp" INT4  NOT NULL DEFAULT '0',
  "title" text,
  "text" TEXT DEFAULT '' NOT NULL,
  "active" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_block_news
--

-- --------------------------------------------------------

--
-- Table structure for table srbase_block_sitelinks
--




--
-- Sequences for table SRBASE_BLOCK_SITELINKS
--

CREATE SEQUENCE srbase_block_sitelinks_link_;

CREATE TABLE "srbase_block_sitelinks" (
  "link_id" INT4 DEFAULT nextval('srbase_block_sitelinks_link_'),
  "name" varchar(32) DEFAULT '',
  "href" varchar(64) DEFAULT '',
  "category" varchar(32) DEFAULT 'Other'
);

--
-- Dumping data for table srbase_block_sitelinks
--

INSERT INTO "srbase_block_sitelinks" VALUES (1, 'Logout', 'logout.php', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table srbase_cms_blocks
--




--
-- Sequences for table SRBASE_CMS_BLOCKS
--

CREATE SEQUENCE srbase_cms_blocks_block_id_s;

CREATE TABLE "srbase_cms_blocks" (
  "block_id" INT4 DEFAULT nextval('srbase_cms_blocks_block_id_s'),
  "file" varchar(128) DEFAULT '',
  "position" varchar(32) DEFAULT '',
  "priority" INT2  NOT NULL DEFAULT '0',
  "description" varchar(64) DEFAULT '',
  "template" varchar(64) DEFAULT '',
  "title" varchar(64) DEFAULT 'untitled',
  "user_level" INT2  NOT NULL DEFAULT '5',
  "active" INT2  NOT NULL DEFAULT '0',
  "use_tpl" INT2  NOT NULL DEFAULT '0',
  "static_html" TEXT DEFAULT '' NOT NULL,
  "showtitle" INT2  NOT NULL DEFAULT '1'
);

--
-- Dumping data for table srbase_cms_blocks
--

INSERT INTO "srbase_cms_blocks" VALUES (1, 'news.blk.php', 'center', 2, 'Displays a list of server news', 'news.tpl.html', 'News', 6, 1, 1, '', 0);
INSERT INTO "srbase_cms_blocks" VALUES (2, 'sitelinks.blk.php', 'left', 1, 'A menu of all site links', 'sitelinks.tpl.html', 'Menu', 6, 1, 1, '', 0);
INSERT INTO "srbase_cms_blocks" VALUES (3, 'login.blk.php', 'right', 1, 'A basic login block for M-H', 'login.tpl.html', 'Account Login', 6, 1, 1, '', 1);
INSERT INTO "srbase_cms_blocks" VALUES (4, '', 'center', 1, 'SR Gen Intro', '', 'Introduction', 6, 1, 0, '<div>\r\nShadows Rising RPG Game Engine will allow users to add items, classes, quests, NPCs and locations to create a custom RPG powered by the core engine. Includes the default Shadows Rising Game Module. Written with PHP, Javascript, MySQL/PostgreSQL and XHTML.\r\n</div>', 1);


-- --------------------------------------------------------

--
-- Table structure for table srbase_cms_categories
--




--
-- Sequences for table SRBASE_CMS_CATEGORIES
--

CREATE SEQUENCE srbase_cms_categories_catego;

CREATE TABLE "srbase_cms_categories" (
  "category_id" INT4 DEFAULT nextval('srbase_cms_categories_catego'),
  "title" varchar(32) DEFAULT 'untitled',
  "active" INT2  NOT NULL DEFAULT '1',
  "priority" INT2  NOT NULL DEFAULT '1',
  "user_level" INT2  NOT NULL DEFAULT '6'
);

--
-- Dumping data for table srbase_cms_categories
--

INSERT INTO "srbase_cms_categories" VALUES (1, 'Other', 1, 255, 6);
INSERT INTO "srbase_cms_categories" VALUES (2, 'Administration', 1, 2, 3);
INSERT INTO "srbase_cms_categories" VALUES (3, 'Navigation', 1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table srbase_cms_modules
--




--
-- Sequences for table SRBASE_CMS_MODULES
--

CREATE SEQUENCE srbase_cms_modules_module_id;

CREATE TABLE "srbase_cms_modules" (
  "module_id" INT4 DEFAULT nextval('srbase_cms_modules_module_id'),
  "active" INT2  NOT NULL DEFAULT '0',
  "user_level" INT2  NOT NULL DEFAULT '3',
  "directory" varchar(64) DEFAULT 'unknown',
  "title" varchar(64) DEFAULT 'untitled',
  "addonmenu" INT2  NOT NULL DEFAULT '1',
  "category" varchar(32) DEFAULT 'Other',
  "showtitle" INT2  NOT NULL DEFAULT '1'
);

--
-- Dumping data for table srbase_cms_modules
--

INSERT INTO "srbase_cms_modules" VALUES (1, 1, 6, 'Game_Index', 'Game Index', 1, 'Navigation', 1);
INSERT INTO "srbase_cms_modules" VALUES (3, 1, 6, 'User_Signup', 'User Signup', 1, 'Navigation', 1);
INSERT INTO "srbase_cms_modules" VALUES (4, 1, 3, 'Admin_Submit_News', 'Submit News', 1, 'Administration', 1);
INSERT INTO "srbase_cms_modules" VALUES (5, 1, 6, 'Login_Process', 'Login Process', 0, 'Other', 1);

-- --------------------------------------------------------

--
-- Table structure for table srbase_game_index
--




--
-- Sequences for table SRBASE_GAME_INDEX
--

CREATE SEQUENCE srbase_game_index_game_id_se;

CREATE TABLE "srbase_game_index" (
  "game_id" INT2 DEFAULT nextval('srbase_game_index_game_id_se'),
  "admin_list" TEXT DEFAULT '' NOT NULL,
  "module_id" INT2  NOT NULL DEFAULT '0',
  "module" varchar(64) DEFAULT '',
  "instance" varchar(32) DEFAULT '',
  "hidden" INT2  NOT NULL DEFAULT '0',
  "paused" INT2  NOT NULL DEFAULT '1',
  "rejoin_delay" INT4  NOT NULL DEFAULT '5000',
  "name" varchar(32) DEFAULT '',
  "start_date" INT4  NOT NULL DEFAULT '0',
  "description" TEXT DEFAULT '' NOT NULL,
  "mp_name" varchar(128) DEFAULT 'default',
  "gamestart" INT4  NOT NULL DEFAULT '1'
);

--
-- Dumping data for table srbase_game_index
--

INSERT INTO "srbase_game_index" VALUES (1, '1', 1, 'srmodule', 'srrpg', 0, 1, 5000, 'Shadows Rising RPG', 0, 'This game utilises the default Shadows Rising RPG module. The Shadows Rising RPG is a fantasy epic where players explore a mysterious world. (In Testing!)', 'default');

-- --------------------------------------------------------

--
-- Table structure for table srbase_challenge_record
--



--
-- Sequences for table SRBASE_CHALLENGE_RECORD
--

CREATE SEQUENCE srbase_challenge_record_chal;

CREATE TABLE "srbase_challenge_record" (
  "chal_id" INT4 DEFAULT nextval('srbase_challenge_record_chal'),
  "sessid" varchar(64) DEFAULT '',
  "challenge" varchar(64) DEFAULT '',
  "timestamp" INT4 NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_challenge_record
--


--
-- Table structure for table srbase_forum_categories
--




--
-- Sequences for table SRBASE_FORUM_CATEGORIES
--

CREATE SEQUENCE srbase_forum_categories_cat_;

CREATE TABLE "srbase_forum_categories" (
  "cat_id" INT4 DEFAULT nextval('srbase_forum_categories_cat_'),
  "name" varchar(25) DEFAULT '',
  "description" varchar(255) DEFAULT ''
);

INSERT INTO "srbase_forum_categories" VALUES (1, 'Test Category', 'A simple test category');

--
-- "Table" structure for table srbase_forum_forums
--




--
-- Sequences for table SRBASE_FORUM_FORUMS
--

CREATE SEQUENCE srbase_forum_forums_forum_id;

CREATE TABLE "srbase_forum_forums" (
  "forum_id" INT4 DEFAULT nextval('srbase_forum_forums_forum_id'),
  "cat" INT4 NOT NULL DEFAULT '0',
  "name" varchar(25) DEFAULT '',
  "description" varchar(255) DEFAULT ''
);

INSERT INTO "srbase_forum_forums" VALUES (1, 0, 'Test Forum', 'A test forum');

--
-- "Table" structure for table srbase_forum_topics
--



--
-- Sequences for table SRBASE_FORUM_TOPICS
--

CREATE SEQUENCE srbase_forum_topics_topic_id;

CREATE TABLE "srbase_forum_topics" (
  "topic_id" INT4 DEFAULT nextval('srbase_forum_topics_topic_id'),
  "forum" INT4 NOT NULL DEFAULT '0',
  "name" varchar(25) DEFAULT '',
  "starter" INT4 NOT NULL DEFAULT '0',
  "lastpost" INT4 NOT NULL DEFAULT '0'
);

INSERT INTO "srbase_forum_topics" VALUES (1, 1, 'A test topic' , 1, 0);

--
-- "Table" structure for table srbase_forum_posts
--




--
-- Sequences for table SRBASE_FORUM_POSTS
--

CREATE SEQUENCE srbase_forum_posts_post_id_s;

CREATE TABLE "srbase_forum_posts" (
  "post_id" INT4 DEFAULT nextval('srbase_forum_posts_post_id_s'),
  "topic" INT4 NOT NULL DEFAULT '0',
  "time" varchar(25) DEFAULT '',
  "poster" INT4 NOT NULL DEFAULT '0',
  "title" varchar(25) DEFAULT '',
  "message" TEXT DEFAULT '' NOT NULL,
  "poll" INT4 NOT NULL DEFAULT '0'
);

INSERT INTO "srbase_forum_posts" VALUES (1, 1, '555496413', 1, 'Test Post', 'Test Post', 0);

--
-- "Table" structure for table srbase_forum_poll
--
-- "NOT" SUPPORTED YET

--
-- "Table" structure for table srbase_forum_poll_options
--
-- "NOT" SUPPORTED YET

--
-- "Table" structure for table srbase_forum_poll_votes
--
-- "NOT" SUPPORTED YET

--
-- "Table" structure for table srbase_forum_bans
--
-- "NOT" SUPPORTED YET

--
-- "Table" structure for table srbase_forum_moderators
--
-- "NOT" SUPPORTED YET


--
-- Indexes for table SRBASE_CMS_CATEGORIES
--

CREATE UNIQUE INDEX category_id_srbase_cms_categories_index ON "srbase_cms_categories" ("category_id");

--
-- Indexes for table SRBASE_CMS_BLOCKS
--

CREATE UNIQUE INDEX block_id_srbase_cms_blocks_index ON "srbase_cms_blocks" ("block_id");

--
-- Indexes for table SRBASE_CMS_MODULES
--

CREATE UNIQUE INDEX module_id_srbase_cms_modules_index ON "srbase_cms_modules" ("module_id");

--
-- Indexes for table SRBASE_BLOCK_NEWS
--

CREATE UNIQUE INDEX news_id_srbase_block_news_index ON "srbase_block_news" ("news_id");

--
-- Indexes for table SRBASE_BLOCK_SITELINKS
--

CREATE UNIQUE INDEX link_id_srbase_block_sitelinks_index ON "srbase_block_sitelinks" ("link_id");

--
-- Indexes for table SRBASE_GAME_INDEX
--

CREATE UNIQUE INDEX game_id_srbase_game_index_index ON "srbase_game_index" ("game_id","instance","name");
CREATE UNIQUE INDEX name_srbase_game_index_index ON "srbase_game_index" ("name");

--
-- Sequences for table SRBASE_FORUM_POSTS
--

SELECT SETVAL('srbase_forum_posts_post_id_s',(select case when max("post_id")>0 then max("post_id")+1 else 1 end from "srbase_forum_posts"));

--
-- Sequences for table SRBASE_CMS_CATEGORIES
--

SELECT SETVAL('srbase_cms_categories_catego',(select case when max("category_id")>0 then max("category_id")+1 else 1 end from "srbase_cms_categories"));

--
-- Sequences for table SRBASE_CMS_BLOCKS
--

SELECT SETVAL('srbase_cms_blocks_block_id_s',(select case when max("block_id")>0 then max("block_id")+1 else 1 end from "srbase_cms_blocks"));

--
-- Sequences for table SRBASE_CMS_MODULES
--

SELECT SETVAL('srbase_cms_modules_module_id',(select case when max("module_id")>0 then max("module_id")+1 else 1 end from "srbase_cms_modules"));

--
-- Sequences for table SRBASE_BLOCK_NEWS
--

SELECT SETVAL('srbase_block_news_news_id_se',(select case when max("news_id")>0 then max("news_id")+1 else 1 end from "srbase_block_news"));

--
-- Sequences for table SRBASE_FORUM_FORUMS
--

SELECT SETVAL('srbase_forum_forums_forum_id',(select case when max("forum_id")>0 then max("forum_id")+1 else 1 end from "srbase_forum_forums"));

--
-- Sequences for table SRBASE_CHALLENGE_RECORD
--

SELECT SETVAL('srbase_challenge_record_chal',(select case when max("chal_id")>0 then max("chal_id")+1 else 1 end from "srbase_challenge_record"));

--
-- Sequences for table SRBASE_GAME_INDEX
--

SELECT SETVAL('srbase_game_index_game_id_se',(select case when max("game_id")>0 then max("game_id")+1 else 1 end from "srbase_game_index"));

--
-- Sequences for table SRBASE_FORUM_CATEGORIES
--

SELECT SETVAL('srbase_forum_categories_cat_',(select case when max("cat_id")>0 then max("cat_id")+1 else 1 end from "srbase_forum_categories"));

--
-- Sequences for table SRBASE_FORUM_TOPICS
--

SELECT SETVAL('srbase_forum_topics_topic_id',(select case when max("topic_id")>0 then max("topic_id")+1 else 1 end from "srbase_forum_topics"));

--
-- Sequences for table SRBASE_BLOCK_SITELINKS
--

SELECT SETVAL('srbase_block_sitelinks_link_',(select case when max("link_id")>0 then max("link_id")+1 else 1 end from "srbase_block_sitelinks"));

COMMIT;
