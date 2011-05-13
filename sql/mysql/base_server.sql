# phpMyAdmin SQL Dump
# version 2.5.3-rc2
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Aug 09, 2004 at 08:28 PM
# Server version: 4.0.14
# PHP Version: 4.3.3
# 
# Database : `shadows`
# 

# --------------------------------------------------------

#
# Table structure for table `srbase_block_news`
#

DROP TABLE IF EXISTS `srbase_block_news`;
CREATE TABLE `srbase_block_news` (
  `news_id` int(11) unsigned NOT NULL auto_increment,
  `login_id` int(11) unsigned NOT NULL default '0',
  `login_name` varchar(128) NOT NULL default 'Anonymous',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `title` blob NOT NULL,
  `text` text NOT NULL,
  `active` tinyint(1) unsigned NOT NULL default '0',
  UNIQUE KEY `news_id` (`news_id`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_block_news`
#

# --------------------------------------------------------

#
# Table structure for table `srbase_block_sitelinks`
#

DROP TABLE IF EXISTS `srbase_block_sitelinks`;
CREATE TABLE `srbase_block_sitelinks` (
  `link_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(32) NOT NULL default '',
  `href` varchar(64) NOT NULL default '',
  `category` varchar(32) NOT NULL default 'Other',
  UNIQUE KEY `link_id` (`link_id`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_block_sitelinks`
#

INSERT INTO `srbase_block_sitelinks` VALUES (1, 'Logout', 'logout.php', 'Other');

# --------------------------------------------------------

#
# Table structure for table `srbase_cms_blocks`
#

DROP TABLE IF EXISTS `srbase_cms_blocks`;
CREATE TABLE `srbase_cms_blocks` (
  `block_id` int(11) unsigned NOT NULL auto_increment,
  `file` varchar(128) NOT NULL default '',
  `position` varchar(32) NOT NULL default '',
  `priority` tinyint(4) unsigned NOT NULL default '0',
  `description` varchar(64) NOT NULL default '',
  `template` varchar(64) NOT NULL default '',
  `title` varchar(64) NOT NULL default 'untitled',
  `user_level` tinyint(1) unsigned NOT NULL default '5',
  `active` tinyint(1) unsigned NOT NULL default '0',
  `use_tpl` smallint(1) unsigned NOT NULL default '0',
  `static_html` text NOT NULL,
  `showtitle` tinyint(1) unsigned NOT NULL default '1',
  UNIQUE KEY `block_id` (`block_id`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_cms_blocks`
#

INSERT INTO `srbase_cms_blocks` VALUES (1, 'news.blk.php', 'center', 2, 'Displays a list of server news', 'news.tpl.html', 'News', 6, 1, 1, '', 0);
INSERT INTO `srbase_cms_blocks` VALUES (2, 'sitelinks.blk.php', 'left', 1, 'A menu of all site links', 'sitelinks.tpl.html', 'Menu', 6, 1, 1, '', 0);
INSERT INTO `srbase_cms_blocks` VALUES (3, 'login.blk.php', 'right', 1, 'A basic login block for M-H', 'login.tpl.html', 'Account Login', 6, 1, 1, '', 1);
INSERT INTO `srbase_cms_blocks` VALUES (4, '', 'center', 1, 'SR Gen Intro', '', 'Introduction', 6, 1, 0, '<div>\r\nShadows Rising RPG Game Engine will allow users to add items, classes, quests, NPCs and locations to create a custom RPG powered by the core engine. Includes the default Shadows Rising Game Module. Written with PHP, Javascript, MySQL/PostgreSQL and XHTML.\r\n</div>', 1);


# --------------------------------------------------------

#
# Table structure for table `srbase_cms_categories`
#

DROP TABLE IF EXISTS `srbase_cms_categories`;
CREATE TABLE `srbase_cms_categories` (
  `category_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(32) NOT NULL default 'untitled',
  `active` tinyint(1) unsigned NOT NULL default '1',
  `priority` tinyint(4) unsigned NOT NULL default '1',
  `user_level` tinyint(1) unsigned NOT NULL default '6',
  UNIQUE KEY `category_id` (`category_id`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_cms_categories`
#

INSERT INTO `srbase_cms_categories` VALUES (1, 'Other', 1, 255, 6);
INSERT INTO `srbase_cms_categories` VALUES (2, 'Administration', 1, 2, 3);
INSERT INTO `srbase_cms_categories` VALUES (3, 'Navigation', 1, 1, 6);

# --------------------------------------------------------

#
# Table structure for table `srbase_cms_modules`
#

DROP TABLE IF EXISTS `srbase_cms_modules`;
CREATE TABLE `srbase_cms_modules` (
  `module_id` int(11) unsigned NOT NULL auto_increment,
  `active` tinyint(1) unsigned NOT NULL default '0',
  `user_level` tinyint(1) unsigned NOT NULL default '3',
  `directory` varchar(64) NOT NULL default 'unknown',
  `title` varchar(64) NOT NULL default 'untitled',
  `addonmenu` tinyint(1) unsigned NOT NULL default '1',
  `category` varchar(32) NOT NULL default 'Other',
  `showtitle` tinyint(1) unsigned NOT NULL default '1',
  UNIQUE KEY `module_id` (`module_id`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_cms_modules`
#

INSERT INTO `srbase_cms_modules` VALUES (1, 1, 6, 'Game_Index', 'Game Index', 1, 'Navigation', 1);
INSERT INTO `srbase_cms_modules` VALUES (3, 1, 6, 'User_Signup', 'User Signup', 1, 'Navigation', 1);
INSERT INTO `srbase_cms_modules` VALUES (4, 1, 3, 'Admin_Submit_News', 'Submit News', 1, 'Administration', 1);
INSERT INTO `srbase_cms_modules` VALUES (5, 1, 6, 'Login_Process', 'Login Process', 0, 'Other', 1);

# --------------------------------------------------------

#
# Table structure for table `srbase_game_index`
#

DROP TABLE IF EXISTS `srbase_game_index`;
CREATE TABLE `srbase_game_index` (
  `game_id` tinyint(4) unsigned NOT NULL auto_increment,
  `admin_list` text NOT NULL,
  `module_id` tinyint(4) unsigned NOT NULL default '0',
  `module` varchar(64) NOT NULL default '',
  `instance` varchar(32) NOT NULL default '',
  `hidden` tinyint(1) unsigned NOT NULL default '0',
  `paused` tinyint(1) unsigned NOT NULL default '1',
  `rejoin_delay` int(11) unsigned NOT NULL default '5000',
  `name` varchar(32) NOT NULL default '',
  `start_date` int(11) unsigned NOT NULL default '0',
  `description` text NOT NULL,
  `mp_name` varchar(128) NOT NULL default 'default',
  `gamestart` int(11) unsigned NOT NULL default '1',
  UNIQUE KEY `game_id` (`game_id`,`instance`,`name`),
  UNIQUE KEY `name` (`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_game_index`
#

INSERT INTO `srbase_game_index` VALUES (1, '1', 1, 'srmodule', 'srrpg', 0, 1, 5000, 'Shadows Rising RPG', 0, 'This game utilies the default Shadows Rising RPG module. The Shadows Rising RPG is a fantasy epic where players explore a mysterious world. (In Testing!)', 'default', '1');

# --------------------------------------------------------

#
# Table structure for table `srbase_challenge_record`
#

DROP TABLE IF EXISTS srbase_challenge_record;
CREATE TABLE srbase_challenge_record (
  chal_id int(11) NOT NULL auto_increment,
  sessid varchar(64) NOT NULL default '',
  challenge varchar(64) NOT NULL default '',
  timestamp int(11) NOT NULL default '0',
  PRIMARY KEY  (chal_id)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_challenge_record`
#

# ----------------------------------------------------------

#
# Table structure for table `srbase_permissions`
#

DROP TABLE IF EXISTS `srbase_permissions`;
CREATE TABLE `srbase_permissions` (
  `user_id` mediumint(8) unsigned NOT NULL default 0,
  `perm_option` varchar(15) NOT NULL default '',
  `perm_setting` tinyint(2) NOT NULL default 0,
  KEY `user_id` (`user_id`),
  KEY `auth_option_id` (`perm_option`)
) TYPE=MyISAM; 