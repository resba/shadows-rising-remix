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
# Table structure for table `srbase_srmodule_classes`
#

DROP TABLE IF EXISTS `srbase_srmodule_classes`;
CREATE TABLE `srbase_srmodule_classes` (
  `class_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `description` text NOT NULL,
  `start_hp` int(11) unsigned NOT NULL default '0',
  `level_details` text NOT NULL,
  `hp_increment` tinyint(2) unsigned NOT NULL default '10',
  `skill_increment` tinyint(2) unsigned NOT NULL default '1',
  `firstlevel_skill_multiplier` tinyint(2) unsigned NOT NULL default '0',
  UNIQUE KEY `class_id` (`class_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_classes`
#

INSERT INTO `srbase_srmodule_classes` VALUES (1, 'Fighter', 'Fighter live for one thing only - to fight. Whether in wars, mercenary jobs or bar brawls, these are the last people you ever want to encounter!', 20, 'a:20:{i:1;a:5:{s:17:"base_attack_bonus";s:1:"1";s:9:"fort_save";s:1:"2";s:8:"ref_save";s:1:"0";s:9:"will_save";s:1:"0";s:5:"feats";s:6:"true|2";}i:2;a:5:{s:17:"base_attack_bonus";s:1:"2";s:9:"fort_save";s:1:"3";s:8:"ref_save";s:1:"0";s:9:"will_save";s:1:"0";s:5:"feats";s:6:"true|2";}i:3;a:5:{s:17:"base_attack_bonus";s:1:"3";s:9:"fort_save";s:1:"3";s:8:"ref_save";s:1:"1";s:9:"will_save";s:1:"1";s:5:"feats";s:7:"false|0";}i:4;a:5:{s:17:"base_attack_bonus";s:1:"4";s:9:"fort_save";s:1:"4";s:8:"ref_save";s:1:"1";s:9:"will_save";s:1:"1";s:5:"feats";s:6:"true|2";}i:5;a:5:{s:17:"base_attack_bonus";s:1:"5";s:9:"fort_save";s:1:"4";s:8:"ref_save";s:1:"1";s:9:"will_save";s:1:"1";s:5:"feats";s:7:"false|0";}i:6;a:5:{s:17:"base_attack_bonus";s:1:"6";s:9:"fort_save";s:1:"5";s:8:"ref_save";s:1:"2";s:9:"will_save";s:1:"2";s:5:"feats";s:6:"true|2";}i:7;a:5:{s:17:"base_attack_bonus";s:1:"7";s:9:"fort_save";s:1:"5";s:8:"ref_save";s:1:"2";s:9:"will_save";s:1:"2";s:5:"feats";s:7:"false|0";}i:8;a:5:{s:17:"base_attack_bonus";s:1:"8";s:9:"fort_save";s:1:"6";s:8:"ref_save";s:1:"2";s:9:"will_save";s:1:"2";s:5:"feats";s:7:"false|0";}i:9;a:5:{s:17:"base_attack_bonus";s:1:"9";s:9:"fort_save";s:1:"6";s:8:"ref_save";s:1:"3";s:9:"will_save";s:1:"3";s:5:"feats";s:7:"false|0";}i:10;a:5:{s:17:"base_attack_bonus";s:2:"10";s:9:"fort_save";s:1:"7";s:8:"ref_save";s:1:"3";s:9:"will_save";s:1:"3";s:5:"feats";s:7:"false|0";}i:11;a:5:{s:17:"base_attack_bonus";s:2:"11";s:9:"fort_save";s:1:"7";s:8:"ref_save";s:1:"3";s:9:"will_save";s:1:"3";s:5:"feats";s:6:"true|2";}i:12;a:5:{s:17:"base_attack_bonus";s:2:"12";s:9:"fort_save";s:1:"8";s:8:"ref_save";s:1:"4";s:9:"will_save";s:1:"4";s:5:"feats";s:7:"false|0";}i:13;a:5:{s:17:"base_attack_bonus";s:2:"13";s:9:"fort_save";s:1:"8";s:8:"ref_save";s:1:"4";s:9:"will_save";s:1:"4";s:5:"feats";s:6:"true|2";}i:14;a:5:{s:17:"base_attack_bonus";s:2:"14";s:9:"fort_save";s:1:"9";s:8:"ref_save";s:1:"4";s:9:"will_save";s:1:"4";s:5:"feats";s:7:"false|0";}i:15;a:5:{s:17:"base_attack_bonus";s:2:"15";s:9:"fort_save";s:1:"9";s:8:"ref_save";s:1:"5";s:9:"will_save";s:1:"5";s:5:"feats";s:6:"true|2";}i:16;a:5:{s:17:"base_attack_bonus";s:2:"16";s:9:"fort_save";s:2:"10";s:8:"ref_save";s:1:"5";s:9:"will_save";s:1:"5";s:5:"feats";s:7:"false|0";}i:17;a:5:{s:17:"base_attack_bonus";s:2:"17";s:9:"fort_save";s:2:"10";s:8:"ref_save";s:1:"5";s:9:"will_save";s:1:"5";s:5:"feats";s:6:"true|2";}i:18;a:5:{s:17:"base_attack_bonus";s:2:"18";s:9:"fort_save";s:2:"11";s:8:"ref_save";s:1:"6";s:9:"will_save";s:1:"6";s:5:"feats";s:7:"false|0";}i:19;a:5:{s:17:"base_attack_bonus";s:2:"19";s:9:"fort_save";s:2:"11";s:8:"ref_save";s:1:"6";s:9:"will_save";s:1:"6";s:5:"feats";s:7:"false|0";}i:20;a:5:{s:17:"base_attack_bonus";s:2:"20";s:9:"fort_save";s:2:"12";s:8:"ref_save";s:1:"6";s:9:"will_save";s:1:"6";s:5:"feats";s:6:"true|2";}}', 10, 2, 4);
INSERT INTO `srbase_srmodule_classes` VALUES (2, 'Wizard', 'Wizards are masters of structured magic. Their powers are generated through often complex spells and enchanted items. Generally weaker than more muscle-bound classes, although Generals are rarely stupid enough to go to war without at least one.', 10, 'a:20:{i:1;a:5:{s:17:"base_attack_bonus";s:1:"0";s:9:"fort_save";s:1:"0";s:8:"ref_save";s:1:"0";s:9:"will_save";s:1:"2";s:5:"feats";s:7:"false|0";}i:2;a:5:{s:17:"base_attack_bonus";s:1:"1";s:9:"fort_save";s:1:"0";s:8:"ref_save";s:1:"0";s:9:"will_save";s:1:"3";s:5:"feats";s:7:"false|0";}i:3;a:5:{s:17:"base_attack_bonus";s:1:"1";s:9:"fort_save";s:1:"1";s:8:"ref_save";s:1:"1";s:9:"will_save";s:1:"3";s:5:"feats";s:7:"false|0";}i:4;a:5:{s:17:"base_attack_bonus";s:1:"2";s:9:"fort_save";s:1:"1";s:8:"ref_save";s:1:"1";s:9:"will_save";s:1:"4";s:5:"feats";s:7:"false|0";}i:5;a:5:{s:17:"base_attack_bonus";s:1:"2";s:9:"fort_save";s:1:"1";s:8:"ref_save";s:1:"1";s:9:"will_save";s:1:"4";s:5:"feats";s:6:"true|1";}i:6;a:5:{s:17:"base_attack_bonus";s:1:"3";s:9:"fort_save";s:1:"2";s:8:"ref_save";s:1:"2";s:9:"will_save";s:1:"5";s:5:"feats";s:7:"false|0";}i:7;a:5:{s:17:"base_attack_bonus";s:1:"3";s:9:"fort_save";s:1:"2";s:8:"ref_save";s:1:"2";s:9:"will_save";s:1:"5";s:5:"feats";s:7:"false|0";}i:8;a:5:{s:17:"base_attack_bonus";s:1:"4";s:9:"fort_save";s:1:"2";s:8:"ref_save";s:1:"2";s:9:"will_save";s:1:"6";s:5:"feats";s:7:"false|0";}i:9;a:5:{s:17:"base_attack_bonus";s:1:"4";s:9:"fort_save";s:1:"3";s:8:"ref_save";s:1:"3";s:9:"will_save";s:1:"6";s:5:"feats";s:7:"false|0";}i:10;a:5:{s:17:"base_attack_bonus";s:1:"5";s:9:"fort_save";s:1:"3";s:8:"ref_save";s:1:"3";s:9:"will_save";s:1:"7";s:5:"feats";s:6:"true|1";}i:11;a:5:{s:17:"base_attack_bonus";s:1:"5";s:9:"fort_save";s:1:"3";s:8:"ref_save";s:1:"3";s:9:"will_save";s:1:"7";s:5:"feats";s:7:"false|0";}i:12;a:5:{s:17:"base_attack_bonus";s:1:"6";s:9:"fort_save";s:1:"4";s:8:"ref_save";s:1:"4";s:9:"will_save";s:1:"8";s:5:"feats";s:7:"false|0";}i:13;a:5:{s:17:"base_attack_bonus";s:1:"6";s:9:"fort_save";s:1:"4";s:8:"ref_save";s:1:"4";s:9:"will_save";s:1:"8";s:5:"feats";s:7:"false|0";}i:14;a:5:{s:17:"base_attack_bonus";s:1:"7";s:9:"fort_save";s:1:"4";s:8:"ref_save";s:1:"4";s:9:"will_save";s:1:"9";s:5:"feats";s:7:"false|0";}i:15;a:5:{s:17:"base_attack_bonus";s:1:"7";s:9:"fort_save";s:1:"5";s:8:"ref_save";s:1:"5";s:9:"will_save";s:1:"9";s:5:"feats";s:6:"true|1";}i:16;a:5:{s:17:"base_attack_bonus";s:1:"8";s:9:"fort_save";s:1:"5";s:8:"ref_save";s:1:"5";s:9:"will_save";s:2:"10";s:5:"feats";s:7:"false|0";}i:17;a:5:{s:17:"base_attack_bonus";s:1:"8";s:9:"fort_save";s:1:"5";s:8:"ref_save";s:1:"5";s:9:"will_save";s:2:"10";s:5:"feats";s:7:"false|0";}i:18;a:5:{s:17:"base_attack_bonus";s:1:"9";s:9:"fort_save";s:1:"6";s:8:"ref_save";s:1:"6";s:9:"will_save";s:2:"11";s:5:"feats";s:7:"false|0";}i:19;a:5:{s:17:"base_attack_bonus";s:1:"9";s:9:"fort_save";s:1:"6";s:8:"ref_save";s:1:"6";s:9:"will_save";s:2:"11";s:5:"feats";s:7:"false|0";}i:20;a:5:{s:17:"base_attack_bonus";s:2:"10";s:9:"fort_save";s:1:"6";s:8:"ref_save";s:1:"6";s:9:"will_save";s:2:"12";s:5:"feats";s:6:"true|1";}}', 5, 2, 2);

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_creatures`
#

DROP TABLE IF EXISTS `srbase_srmodule_creatures`;
CREATE TABLE `srbase_srmodule_creatures` (
  `creature_id` int(11) unsigned NOT NULL auto_increment,
  `access_flag` tinyint(1) unsigned NOT NULL default '1',
  `name` varchar(64) NOT NULL default 'Unidentified Menace',
  `description` text NOT NULL,
  `encounter_level` tinyint(2) unsigned NOT NULL default '1',
  `level` tinyint(2) unsigned NOT NULL default '1',
  `size` varchar(16) NOT NULL default 'Medium',
  `type` varchar(16) NOT NULL default 'Normal',
  `health` int(11) unsigned NOT NULL default '10',
  `armour_class` int(11) unsigned NOT NULL default '0',
  `weapon_id` int(11) unsigned NOT NULL default '0',
  `armour_id` int(11) unsigned NOT NULL default '0',
  `str` tinyint(3) unsigned NOT NULL default '0',
  `dex` tinyint(3) unsigned NOT NULL default '0',
  `con` tinyint(3) unsigned NOT NULL default '0',
  `intel` tinyint(3) unsigned NOT NULL default '0',
  `wis` tinyint(3) unsigned NOT NULL default '0',
  `cha` tinyint(3) unsigned NOT NULL default '0',
  UNIQUE KEY `creature_id` (`creature_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

#
# Dumping data for table `srbase_srmodule_creatures`
#

INSERT INTO `srbase_srmodule_creatures` VALUES (1, 1, 'Giant Kangaroo', 'A fairly common irritation on the plains of Nemedia - approach carefully as these creatures use a mystical combat technique termed kickpunching...', 1, 1, 'Large', 'Normal', 25, 0, 0, 0, 10, 5, 5, 2, 2, 2);

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items`
#

DROP TABLE IF EXISTS `srbase_srmodule_items`;
CREATE TABLE `srbase_srmodule_items` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `alignment` varchar(7) NOT NULL default 'neutral',
  `equip_penalty` varchar(4) NOT NULL default 'none',
  `penalty_amount` tinyint(4) unsigned NOT NULL default '0',
  `max_damage` tinyint(4) unsigned NOT NULL default '0',
  `min_critical` tinyint(4) unsigned NOT NULL default '0',
  `max_critical` tinyint(4) unsigned NOT NULL default '0',
  `critical_multiplier` tinyint(4) unsigned NOT NULL default '0',
  `handle` varchar(32) NOT NULL default 'single',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items`
#

INSERT INTO `srbase_srmodule_items` VALUES (1, 'weapon', 'Ancient Rusty Dagger', 'Found buried in the thatch of a 90 year old Human\'s hut, this Ancient Rusty Dagger has seen better days than today!', 1, 10, 1, 0, 'neutral', 'none', 0, 4, 19, 20, 2, 'single');
INSERT INTO `srbase_srmodule_items` VALUES (2, 'weapon', 'Cracked Wooden Staff', 'Looks like that 90 year-old Human kept a few ill-kept weapons in his thatch!', 1, 10, 1, 0, 'neutral', 'none', 0, 6, 19, 20, 3, 'double');

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_belts`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_belts`;
CREATE TABLE `srbase_srmodule_items_belts` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `alignment` varchar(7) NOT NULL default 'neutral',
  `equip_penalty` varchar(4) NOT NULL default 'none',
  `penalty_amount` tinyint(4) unsigned NOT NULL default '0',
  `effect` varchar(32) NOT NULL default 'nothing',
  `effect_type` varchar(32) NOT NULL default 'none',
  `effect_amount` tinyint(2) unsigned NOT NULL default '0',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_belts`
#

INSERT INTO `srbase_srmodule_items_belts` VALUES (1, 'belt', 'Old Mans Belt', 'Yet another artifact from everyones favourite human - his old leather belt!', 1, 15, 1, 0, 'neutral', 'none', 0, 'attribute', 'con', 1);

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_bracers`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_bracers`;
CREATE TABLE `srbase_srmodule_items_bracers` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `alignment` varchar(7) NOT NULL default 'neutral',
  `equip_penalty` varchar(4) NOT NULL default 'none',
  `penalty_amount` tinyint(4) unsigned NOT NULL default '0',
  `effect` varchar(32) NOT NULL default 'nothing',
  `effect_type` varchar(32) NOT NULL default 'none',
  `effect_amount` tinyint(2) unsigned NOT NULL default '0',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_bracers`
#

INSERT INTO `srbase_srmodule_items_bracers` VALUES (1, 'bracer', 'Leather Bracers', 'Serviceable if not exactly polished new - these bracers offer some protection against damage to your forearms.', 1, 45, 1, 0, 'neutral', 'none', 0, 'armour', 'natural', 1);

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_cloaks`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_cloaks`;
CREATE TABLE `srbase_srmodule_items_cloaks` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `alignment` varchar(7) NOT NULL default 'neutral',
  `equip_penalty` varchar(4) NOT NULL default 'none',
  `penalty_amount` tinyint(4) unsigned NOT NULL default '0',
  `effect` varchar(32) NOT NULL default 'nothing',
  `effect_type` varchar(32) NOT NULL default 'none',
  `effect_amount` tinyint(2) unsigned NOT NULL default '0',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_cloaks`
#

INSERT INTO `srbase_srmodule_items_cloaks` VALUES (1, 'cloak', 'Cloak of the Acrobats', 'Purchased from a Bard who claimed he needed the gold to retire, he depended on this cloak to perform amazing acrobatic feats.', 1, 75, 1, 0, 'neutral', 'none', 0, 'attribute', 'dex', 1);

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_drugs`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_drugs`;
CREATE TABLE `srbase_srmodule_items_drugs` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `effect` varchar(32) NOT NULL default 'nothing',
  `effect_type` varchar(32) NOT NULL default 'none',
  `effect_amount` tinyint(2) NOT NULL default '0',
  `physical` varchar(32) NOT NULL default 'nothing',
  `physical_amount` tinyint(2) NOT NULL default '0',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_drugs`
#

INSERT INTO `srbase_srmodule_items_drugs` VALUES (1, 'health', 'Lesser Healing Potion', 'The Lesser Healing Potion is a simple (and cheap) herbal remedy commonly used across Nemedia. The effect of the potion is to restore up to 10 health points.', 1, 12, 1, 0, 'nothing', 'none', 0, 'health', 10);


# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_gauntlets`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_gauntlets`;
CREATE TABLE `srbase_srmodule_items_gauntlets` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `alignment` varchar(7) NOT NULL default 'neutral',
  `equip_penalty` varchar(4) NOT NULL default 'none',
  `penalty_amount` tinyint(4) unsigned NOT NULL default '0',
  `effect` varchar(32) NOT NULL default 'nothing',
  `effect_type` varchar(32) NOT NULL default 'none',
  `effect_amount` tinyint(2) unsigned NOT NULL default '0',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_gauntlets`
#


# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_headgear`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_headgear`;
CREATE TABLE `srbase_srmodule_items_headgear` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `alignment` varchar(7) NOT NULL default 'neutral',
  `equip_penalty` varchar(4) NOT NULL default 'none',
  `penalty_amount` tinyint(4) unsigned NOT NULL default '0',
  `effect` varchar(32) NOT NULL default 'nothing',
  `effect_type` varchar(32) NOT NULL default 'none',
  `effect_amount` tinyint(2) unsigned NOT NULL default '0',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_headgear`
#


# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_neckwear`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_neckwear`;
CREATE TABLE `srbase_srmodule_items_neckwear` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `alignment` varchar(7) NOT NULL default 'neutral',
  `equip_penalty` varchar(4) NOT NULL default 'none',
  `penalty_amount` tinyint(4) unsigned NOT NULL default '0',
  `effect` varchar(32) NOT NULL default 'nothing',
  `effect_type` varchar(32) NOT NULL default 'none',
  `effect_amount` tinyint(2) unsigned NOT NULL default '0',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_neckwear`
#


# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_rings`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_rings`;
CREATE TABLE `srbase_srmodule_items_rings` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `alignment` varchar(7) NOT NULL default 'neutral',
  `equip_penalty` varchar(4) NOT NULL default 'none',
  `penalty_amount` tinyint(4) unsigned NOT NULL default '0',
  `effect` varchar(32) NOT NULL default 'nothing',
  `effect_type` varchar(32) NOT NULL default 'none',
  `effect_amount` tinyint(2) unsigned NOT NULL default '0',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_rings`
#

INSERT INTO `srbase_srmodule_items_rings` VALUES (1, 'ring', 'Ring of Strength', 'A common enough item employed by the Fighter Class in particular. This ring increases a character\\\'s strength and therefore damage dealt by any weapon.', 1, 50, 1, 0, 'neutral', 'none', 0, 'attribute', 'str', 1);

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_texts`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_texts`;
CREATE TABLE `srbase_srmodule_items_texts` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_texts`
#


# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_tools`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_tools`;
CREATE TABLE `srbase_srmodule_items_tools` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `skill_id` int(11) unsigned NOT NULL default '0',
  `skill_amount` tinyint(2) unsigned NOT NULL default '0',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_tools`
#


# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_items_weapons`
#

DROP TABLE IF EXISTS `srbase_srmodule_items_weapons`;
CREATE TABLE `srbase_srmodule_items_weapons` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `type` varchar(32) NOT NULL default 'miscellaneous',
  `name` varchar(64) NOT NULL default 'Unidentified',
  `description` text NOT NULL,
  `level` tinyint(4) unsigned NOT NULL default '1',
  `cost` int(11) unsigned NOT NULL default '10',
  `weight` tinyint(4) unsigned NOT NULL default '1',
  `class_special` tinyint(4) unsigned NOT NULL default '0',
  `alignment` varchar(7) NOT NULL default 'neutral',
  `equip_penalty` varchar(4) NOT NULL default 'none',
  `penalty_amount` tinyint(4) unsigned NOT NULL default '0',
  `max_damage` tinyint(4) unsigned NOT NULL default '0',
  `min_critical` tinyint(4) unsigned NOT NULL default '0',
  `max_critical` tinyint(4) unsigned NOT NULL default '0',
  `critical_multiplier` tinyint(4) unsigned NOT NULL default '0',
  `handle` varchar(32) NOT NULL default 'single',
  UNIQUE KEY `item_id` (`item_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_items_weapons`
#

INSERT INTO `srbase_srmodule_items_weapons` VALUES (1, 'weapon', 'Ancient Rusty Dagger', 'Found buried in the thatch of a 90 year old Humans hut, this Ancient Rusty Dagger has seen better days than today!', 1, 10, 1, 0, 'neutral', 'none', 0, 4, 19, 20, 2, 'single');
INSERT INTO `srbase_srmodule_items_weapons` VALUES (2, 'weapon', 'Cracked Wooden Staff', 'Looks like that 90 year-old Human kept a few ill-kept weapons in his thatch!', 1, 10, 1, 0, 'neutral', 'none', 0, 6, 19, 20, 3, 'double');

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_itemtypes`
#

DROP TABLE IF EXISTS `srbase_srmodule_itemtypes`;
CREATE TABLE `srbase_srmodule_itemtypes` (
  `type_id` int(11) unsigned NOT NULL auto_increment,
  `type` varchar(32) NOT NULL default '',
  `db_postfix` varchar(32) NOT NULL default 'misc',
  UNIQUE KEY `type_id` (`type_id`,`type`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_itemtypes`
#

INSERT INTO `srbase_srmodule_itemtypes` VALUES (1, 'weapon', 'weapons');
INSERT INTO `srbase_srmodule_itemtypes` VALUES (2, 'amulet', 'neckwear');
INSERT INTO `srbase_srmodule_itemtypes` VALUES (3, 'belt', 'belts');
INSERT INTO `srbase_srmodule_itemtypes` VALUES (4, 'bracer', 'bracers');
INSERT INTO `srbase_srmodule_itemtypes` VALUES (5, 'cloak', 'cloaks');
INSERT INTO `srbase_srmodule_itemtypes` VALUES (6, 'gauntlet', 'gauntlets');
INSERT INTO `srbase_srmodule_itemtypes` VALUES (7, 'drug', 'drugs');
INSERT INTO `srbase_srmodule_itemtypes` VALUES (8, 'headgear', 'headgear');
INSERT INTO `srbase_srmodule_itemtypes` VALUES (9, 'ring', 'rings');
INSERT INTO `srbase_srmodule_itemtypes` VALUES (10, 'tool', 'tools');
INSERT INTO `srbase_srmodule_itemtypes` VALUES (11, 'text', 'texts');

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_races`
#

DROP TABLE IF EXISTS `srbase_srmodule_races`;
CREATE TABLE `srbase_srmodule_races` (
  `race_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `preferred_class` int(11) unsigned NOT NULL default '0',
  `description` text NOT NULL,
  `modifiers` text NOT NULL,
  `feats` text NOT NULL,
  UNIQUE KEY `race_id` (`race_id`,`name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_races`
#

INSERT INTO `srbase_srmodule_races` VALUES (1, 'Elaran', 0, 'The Elaran are renowned as a peaceful yet hardy race. Many races often look down on the Elaran, their predominantly round facial features, auburn or black hair and legendary adaptability seen as a throwback to the lesser Humans who roamed the Homeworld. To their credit however, the Elaran rule a vast territory and are considered fierce allies of the Tuatha\'an. Many find such a solid alliance between the most mystical of races and the most practical impossible to explain. Rumours indicate that the Elaran who have their own fair share of mystics and magicians just might be the sole race capable of understanding Tuatha\'an humour...', 'a:6:{s:3:"str";s:1:"0";s:3:"dex";s:1:"0";s:3:"con";s:1:"0";s:5:"intel";s:1:"0";s:3:"wis";s:1:"0";s:3:"cha";s:1:"0";}', 'a:2:{i:0;s:9:"adaptable";i:1;s:8:"stubborn";}');
INSERT INTO `srbase_srmodule_races` VALUES (2, 'Tuathaan', 0, 'The Tuathaan are an ancient mystical race rumoured to have migrated from the icy wastelands of the north on clouds. Tuatha\'an Druids are among the foremost magic wielders in Nemedia with an unusual willingness to share their learning. The fair headed people of this race refuse to worship Gods, instead treating all deaties as equals (much to the dismay of all priests and shamans). The Tuathaan are a society composed of clans, ruled by a King or Queen who is voted into such a role by the annual gathering of Clan Chieftains. Unusually iron is anathema to the Tuathaan, to the extent that they use bronze for all their metalworking needs. For people with such a high value on honour, they are also among the most ruthless of gamblers. It is rumoured that the annual Druid Council is attended by Lugh, the God of Dice, in person.', 'a:6:{s:3:"str";s:2:"-1";s:3:"dex";s:1:"1";s:3:"con";s:2:"-1";s:5:"intel";s:1:"1";s:3:"wis";s:1:"0";s:3:"cha";s:1:"0";}', 'a:3:{i:0;s:9:"mysticism";i:1;s:8:"iceproof";i:2;s:12:"ironweakness";}');
INSERT INTO `srbase_srmodule_races` VALUES (3, 'Fomorian', 0, 'The Fomorians are as old as the Tuatha\'an, but nowhere as civilised. A race of island dwelling giants, as much at home in the sea as on dry land, the Fomorians look nothing so much as giant savages in ragged clothing with a conspicuous set of gills on their necks. Little is known of their women, as only the men ever visit the mainland to trade. Although not an evil race, the Fomorians are the focus of most peoples\' suspicions given their history of war against their age-old rivals, the Tuatha\'an. Unmatched for sheer strength in battle, the Fomorians disdain armour and are feared by every sea vessel for their ability to breathe underwater and their almost inevitable connection to every pirate group at sea. The Fomorii Islands, a desolate collection of shallow rocky isles, are protected by both an army of these giants and their overlords, the magic wielding Sea Masters. Perhaps the only group to match the Druids when it comes to elemental control over water, the Sea Masters are a force to be reckoned with, and their past wars have crippled the northern nations more than once. ', 'a:6:{s:3:"str";s:1:"2";s:3:"dex";s:1:"0";s:3:"con";s:1:"1";s:5:"intel";s:2:"-1";s:3:"wis";s:1:"0";s:3:"cha";s:2:"-2";}', 'a:2:{i:0;s:14:"waterbreathing";i:1;s:14:"naturalswimmer";}');


# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_maps`
#

DROP TABLE IF EXISTS `srbase_srmodule_maps`;
CREATE TABLE `srbase_srmodule_maps` (
  `map_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(32) NOT NULL default 'unnamed',
  `height` tinyint(3) unsigned NOT NULL default '0',
  `width` tinyint(3) unsigned NOT NULL default '0',
  `num_tiles` int(11) unsigned NOT NULL default '0',
  UNIQUE KEY `map_id` (`map_id`,`name`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_maptiles`
#

DROP TABLE IF EXISTS `srbase_srmodule_maptiles`;
CREATE TABLE `srbase_srmodule_maptiles` (
  `tile_id` int(11) unsigned NOT NULL auto_increment,
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
  UNIQUE KEY `tile_id` (`tile_id`)
) TYPE=MyISAM;

# --------------------------------------------------------


#
# Table structure for table `srbase_srmodule_skills`
#

DROP TABLE IF EXISTS `srbase_srmodule_skills`;
CREATE TABLE `srbase_srmodule_skills` (
  `skill_id` int(11) unsigned NOT NULL auto_increment,
  `skill_name` varchar(32) NOT NULL default 'unknown',
  `skill_code` varchar(16) NOT NULL default '',
  `use_modifier` varchar(32) NOT NULL default 'intel',
  `description` text NOT NULL,
  `notimelimit` tinyint(1) unsigned NOT NULL default '0',
  `untrained` tinyint(1) unsigned NOT NULL default '0',
  UNIQUE KEY `skill_id` (`skill_id`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_skills`
#

INSERT INTO `srbase_srmodule_skills` VALUES (1, 'Concentration', 'concentration', 'con', 'Concentration is required when performing any task in which you must not be distracted. A successful check means you successfully perform the action, otherwise the action will fail and be wasted.', 0, 1);
INSERT INTO `srbase_srmodule_skills` VALUES (2, 'Heal', 'heal', 'wis', 'Healing is always a useful skill, making the most of whatever limited healing supplies are available is not a skill to sneer at.', 1, 1);
INSERT INTO `srbase_srmodule_skills` VALUES (3, 'Lock Picking', 'picklock', 'dex', 'Whether it\'s opening some noble\'s strongbox, or gaining entry to a locked room - unless you have other means at your disposal you better know how to pick locks!', 0, 1);
INSERT INTO `srbase_srmodule_skills` VALUES (4, 'Search', 'search', 'intel', 'Searching is a skill useful for finding those items that others would prefer remain hidden. This could be a hidden entrance or alcove, a cleverly disguised trap, or even the tracks of someone you are seeking out.', 1, 1);

# --------------------------------------------------------

#
# Table structure for table `srbase_srmodule_skilltests`
#

DROP TABLE IF EXISTS `srbase_srmodule_skilltests`;
CREATE TABLE `srbase_srmodule_skilltests` (
  `test_id` int(11) unsigned NOT NULL auto_increment,
  `test_name` varchar(32) NOT NULL default '',
  `type` varchar(32) NOT NULL default '',
  `skill_code` varchar(32) NOT NULL default '',
  `default_dc` tinyint(1) unsigned NOT NULL default '5',
  UNIQUE KEY `test_id` (`test_id`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_srmodule_skilltests`
#

INSERT INTO `srbase_srmodule_skilltests` VALUES (1, 'Lockpicking', 'picklock', 'picklock', 5);  