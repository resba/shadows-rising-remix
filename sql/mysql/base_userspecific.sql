# phpMyAdmin SQL Dump
# version 2.5.3-rc2
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Aug 09, 2004 at 08:26 PM
# Server version: 4.0.14
# PHP Version: 4.3.3
# 
# Database : `shadows`
# 

# --------------------------------------------------------

#
# Table structure for table `srbase_users_accounts`
#

DROP TABLE IF EXISTS `srbase_users_accounts`;
CREATE TABLE `srbase_users_accounts` (
  `login_id` int(11) NOT NULL auto_increment,
  `login_name` varchar(30) NOT NULL default '',
  `passwd` varchar(45) NOT NULL default '',
  `auth` int(11) NOT NULL default '0',
  `first_name` varchar(30) NOT NULL default '',
  `last_name` varchar(30) NOT NULL default '',
  `email_address` varchar(40) NOT NULL default '',
  `icq` int(11) NOT NULL default '0',
  `aim` varchar(50) NOT NULL default '',
  `msn` varchar(50) NOT NULL default '',
  `yim` varchar(50) NOT NULL default '',
  `signed_up` int(11) NOT NULL default '0',
  `session_exp` int(11) NOT NULL default '0',
  `session_id` int(11) NOT NULL default '0',
  `last_login` int(11) NOT NULL default '0',
  `login_count` int(11) NOT NULL default '0',
  `last_ip` varchar(16) NOT NULL default '',
  `num_games_joined` int(11) NOT NULL default '0',
  `total_score` int(11) NOT NULL default '0',
  `con_speed` tinyint(4) NOT NULL default '2',
  `default_color_scheme` tinyint(4) NOT NULL default '1',
  `country` varchar(150) NOT NULL default '',
  `hear_from` varchar(150) NOT NULL default '',
  `e_list` tinyint(4) NOT NULL default '1',
  `birth_date` int(11) NOT NULL default '0',
  `sex` tinyint(4) NOT NULL default '0',
  `hint_question` text NOT NULL,
  `hint_answer` text NOT NULL,
  PRIMARY KEY  (`login_id`),
  UNIQUE KEY `login_name` (`login_name`),
  UNIQUE KEY `email_address` (`email_address`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_users_accounts`
#

INSERT INTO `srbase_users_accounts` VALUES (1, 'Admin', '76a2173be6393254e72ffa4d6df1030a', 0, 'The', 'Administrator', 'admin@fakemail.com', 0, '', '', '', 1084986985, 1091820346, 8672, 1091819104, 112, '127.0.0.1', 0, 0, 2, 1, 'ie', '', 1, 0, 0, '', '');

# --------------------------------------------------------

#
# Table structure for table `srbase_users_permissions`
#

DROP TABLE IF EXISTS `srbase_users_permissions`;
CREATE TABLE `srbase_users_permissions` (
  `login_id` int(11) unsigned NOT NULL default '0',
  `login_name` varchar(32) NOT NULL default '',
  `admin` tinyint(1) unsigned NOT NULL default '0',
  `deity` tinyint(1) unsigned NOT NULL default '0',
  `developer` tinyint(1) unsigned NOT NULL default '0',
  `moderator` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`login_id`),
  UNIQUE KEY `login_name` (`login_name`)
) TYPE=MyISAM;

#
# Dumping data for table `srbase_users_permissions`
#

INSERT INTO `srbase_users_permissions` VALUES (1, 'Admin', 1, 1, 0, 0);