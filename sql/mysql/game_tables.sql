# phpMyAdmin SQL Dump
# version 2.5.3-rc2
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Aug 09, 2004 at 08:33 PM
# Server version: 4.0.14
# PHP Version: 4.3.3
# 
# Database : `shadows`
# 

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_srrpg_backpack`
#

DROP TABLE IF EXISTS `srbase_srmodule_srrpg_backpack`;
CREATE TABLE `srbase_srmodule_srrpg_backpack` (
  `pack_id` int(11) unsigned NOT NULL auto_increment,
  `login_id` int(11) unsigned NOT NULL default '0',
  `item_id` int(11) unsigned NOT NULL default '0',
  `item_name` varchar(64) NOT NULL default 'Unidentified',
  `type` varchar(32) NOT NULL default 'Unknown',
  `level` tinyint(4) unsigned NOT NULL default '0',
  `weight` tinyint(4) unsigned NOT NULL default '0',
  `handle` varchar(32) NOT NULL default 'single',
  `equipped` tinyint(4) unsigned NOT NULL default '0',
  `position` varchar(32) NOT NULL default 'backpack',
  `cost` int(11) unsigned NOT NULL default '0',
  UNIQUE KEY `pack_id` (`pack_id`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_srrpg_backpack`
#

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_srrpg_characters`
#

DROP TABLE IF EXISTS `srbase_srmodule_srrpg_characters`;
CREATE TABLE `srbase_srmodule_srrpg_characters` (
  `login_id` int(11) unsigned NOT NULL default '0',
  `login_name` varchar(64) NOT NULL default '',
  `name` varchar(64) NOT NULL default '',
  `race_id` int(3) unsigned NOT NULL default '0',
  `race_name` varchar(64) NOT NULL default 'human',
  `sex` varchar(6) NOT NULL default 'male',
  `class_id` int(3) unsigned NOT NULL default '0',
  `class_name` varchar(64) NOT NULL default '',
  `rank` int(11) unsigned NOT NULL default '0',
  `rank_name` varchar(32) NOT NULL default '',
  `skill_points` tinyint(3) unsigned NOT NULL default '0',
  `hp` int(11) unsigned NOT NULL default '10',
  `level` int(11) unsigned NOT NULL default '1',
  `exp` int(11) unsigned NOT NULL default '0',
  `gold` int(11) unsigned NOT NULL default '100',
  `gems` int(11) unsigned NOT NULL default '0',
  `str` int(3) unsigned NOT NULL default '10',
  `dex` int(3) unsigned NOT NULL default '10',
  `con` int(3) unsigned NOT NULL default '10',
  `intel` int(3) unsigned NOT NULL default '10',
  `wis` int(3) unsigned NOT NULL default '10',
  `cha` int(3) unsigned NOT NULL default '10',
  `char_check` tinyint(1) unsigned NOT NULL default '0',
  `location` int(11) unsigned NOT NULL default '0',
  `modifiers` text NOT NULL,
  `skills` text NOT NULL,
  `feats` text NOT NULL,
  `curr_template_page` varchar(128) NOT NULL default '',
  `curr_template_vars` text NOT NULL,
  `curr_request_uri` varchar(128) NOT NULL default '',
  `curr_allowed_navs` text NOT NULL,
  UNIQUE KEY `login_id` (`login_id`,`login_name`),
  UNIQUE KEY `name` (`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_srrpg_characters`
#

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_srrpg_locations`
#

DROP TABLE IF EXISTS `srbase_srmodule_srrpg_locations`;
CREATE TABLE `srbase_srmodule_srrpg_locations` (
  `loc_id` int(11) unsigned NOT NULL auto_increment,
  `mp_name` varchar(32) NOT NULL default 'unnamed',
  `x_loc` tinyint(4) unsigned NOT NULL default '0',
  `y_loc` tinyint(4) unsigned NOT NULL default '0',
  `terrain_img` varchar(32) NOT NULL default 'no_terrain.gif',
  `nlink` varchar(16) NOT NULL default '',
  `elink` varchar(16) NOT NULL default '',
  `slink` varchar(16) NOT NULL default '',
  `wlink` varchar(16) NOT NULL default '',
  `linked` tinyint(1) unsigned NOT NULL default '0',
  `gamestart` tinyint(1) unsigned NOT NULL default '0',
  UNIQUE KEY `tile_id` (`loc_id`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_srrpg_locations`
#

INSERT INTO `srbase_srmodule_srrpg_locations` VALUES (1, 'default', 1, 10, 'grass_0.gif', '', '', '', '', 1, 0);

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_srrpg_merchants`
#

DROP TABLE IF EXISTS `srbase_srmodule_srrpg_merchants`;
CREATE TABLE `srbase_srmodule_srrpg_merchants` (
  `shop_id` int(11) unsigned NOT NULL default '0',
  `location` int(11) unsigned NOT NULL default '0',
  `item_type` varchar(32) NOT NULL default 'weapon',
  `name` varchar(64) NOT NULL default 'Suspiciously Anonymous Shop',
  `max_level` tinyint(2) unsigned NOT NULL default '1',
  `item_types` text NOT NULL
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_srrpg_merchants`
#

INSERT INTO `srbase_srmodule_srrpg_merchants` VALUES (1, 1, 'weapon', 'Maugrim\'s Weaponry Superstore', 20, 'a:5:{i:0;s:6:"weapon";i:1;s:4:"belt";i:2;s:6:"bracer";i:3;s:5:"cloak";i:4;s:4:"ring";}');
INSERT INTO `srbase_srmodule_srrpg_merchants` VALUES (2, 1, 'drug', 'Sorcha\'s Apothecary', 20, 'a:1:{i:0;s:4:"drug";}');

