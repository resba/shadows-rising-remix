

#
# Table structure for table `srbase_forum_categories`
#

DROP TABLE IF EXISTS `srbase_forum_categories`;
CREATE TABLE `srbase_forum_categories` (
  `cat_id` int(11) unsigned NOT NULL auto_increment,
  `cat_title` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`cat_id`)
) TYPE=MyISAM AUTO_INCREMENT=1;

INSERT INTO `srbase_forum_categories` VALUES (1, 'Test Category');

#
# Table structure for table `srbase_forum_forums`
#

DROP TABLE IF EXISTS `srbase_forum_forums`;
CREATE TABLE `srbase_forum_forums` (
  `forum_id` int(11) unsigned NOT NULL auto_increment,
  `cat_id` int(11) NOT NULL,
  `forum_name` varchar(25) NOT NULL default '',
  `forum_desc` varchar(255) NOT NULL default '',
  `forum_posts` int(11) unsigned NOT NULL default 0,
  `forum_order` tinyint(3) unsigned NOT NULL default 0,
  `forum_status` tinyint(4) unsigned NOT NULL default 0,
  `ingame` tinyint(3) NOT NULL default 0,
  `location` int(11) unsigned NOT NULL default 1,
  PRIMARY KEY  (`forum_id`)
) TYPE=MyISAM AUTO_INCREMENT=2;

INSERT INTO `srbase_forum_forums` VALUES (1, 1, 'Test Forum', 'A test forum', 1, 0, 0, -1, -1);
INSERT INTO `srbase_forum_forums` VALUES (2, -1, 'Test INGAME Forum', 'A test INGAME forum', 1, -1, 0, 1, 1);

#
# Table structure for table `srbase_forum_topics`
#
DROP TABLE IF EXISTS `srbase_forum_topics`;
CREATE TABLE `srbase_forum_topics` (
  `topic_id` int(11) unsigned NOT NULL auto_increment,
  `forum_id` int(11) unsigned NOT NULL,
  `topic_title` varchar(25) NOT NULL default '',
  `topic_starter` int(11) NOT NULL,
  `topic_views` int(11) NOT NULL default 0,
  `topic_posts` int(11) NOT NULL default 0,
  `topic_firstpost` int(11) NOT NULL,
  `topic_lastpost` int(11) NOT NULL,
  `topic_type` tinyint(2) NOT NULL default 0,
  PRIMARY KEY  (`topic_id`)
) TYPE=MyISAM AUTO_INCREMENT=2;

INSERT INTO `srbase_forum_topics` VALUES (1, 1, 'A test topic', 1, 0, 1, 1, 1, 0);
INSERT INTO `srbase_forum_topics` VALUES (2, 2, 'Test INGAME Topic', 1, 0, 2, 2, 3, 0);

#
# Table structure for table `srbase_forum_posts`
#

DROP TABLE IF EXISTS `srbase_forum_posts`;
CREATE TABLE `srbase_forum_posts` (
  `post_id` int(11) unsigned NOT NULL auto_increment,
  `topic_id` int(11) unsigned NOT NULL,
  `post_time` int(11) unsigned NOT NULL,
  `post_poster` int(11) NOT NULL,
  `post_title` varchar(25) NOT NULL default '',
  `post_message` text NOT NULL,
  `post_reported` tinyint(1) NOT NULL default 0,
  `post_poll` int(11) NOT NULL default 0,
  PRIMARY KEY  (`post_id`),
  KEY `post_poll` (`post_poll`)
) TYPE=MyISAM AUTO_INCREMENT=3;

INSERT INTO `srbase_forum_posts` VALUES (1, 1, '555496413', 1, 'Test Post', 'Test Post', 0, 0);
INSERT INTO `srbase_forum_posts` VALUES (2, 2, '555496413', 1, 'Test ingame Post', 'This is a test ingame post', 0, 0); 
INSERT INTO `srbase_forum_posts` VALUES (3, 2, '555496500', 1, 'Bump', 'This is a test ingame, reported bump', 1, 0);


#
# Table structure for table `srbase_forum_prem_users`
#
DROP TABLE IF EXISTS `srbase_forum_perm_users`;
CREATE TABLE `srbase_forum_perm_users` (
  `user_id` mediumint(8) unsigned NOT NULL default 0,
  `forum_id` mediumint(8) unsigned NOT NULL default 0,
  `perm_option` varchar(15) NOT NULL default '',
  `perm_setting` tinyint(2) NOT NULL default 0,
  KEY `user_id` (`user_id`),
  KEY `auth_option_id` (`perm_option`)
) TYPE=MyISAM; 

INSERT INTO `srbase_forum_perm_users` VALUES (0, 0, 'VIEW', 1);
INSERT INTO `srbase_forum_perm_users` VALUES (0, 0, 'READ', 1);
INSERT INTO `srbase_forum_perm_users` VALUES (0, 0, 'POST', 1);
INSERT INTO `srbase_forum_perm_users` VALUES (0, 0, 'REPLY', 1);
INSERT INTO `srbase_forum_perm_users` VALUES (0, 0, 'DELETE_OWN', 1);
INSERT INTO `srbase_forum_perm_users` VALUES (0, 0, 'DELETE', 0);
INSERT INTO `srbase_forum_perm_users` VALUES (0, 0, 'EDIT_OWN', 1);
INSERT INTO `srbase_forum_perm_users` VALUES (0, 0, 'EDIT', 0);

#
# Table structure for table `srbase_forum_perm_groups`
#
DROP TABLE IF EXISTS `srbase_forum_perm_groups`;
CREATE TABLE `srbase_forum_perm_groups` (
  `group_id` mediumint(8) unsigned NOT NULL default 0,
  `forum_id` mediumint(8) unsigned NOT NULL default 0,
  `perm_option` varchar(15) NOT NULL default 0,
  `perm_setting` tinyint(4) NOT NULL default 0,
  KEY `user_id` (`group_id`),
  KEY `auth_option_id` (`perm_option`)
) TYPE=MyISAM; 

INSERT INTO `srbase_forum_perm_groups` VALUES (0, 0, 'VIEW', 1);
INSERT INTO `srbase_forum_perm_groups` VALUES (0, 0, 'READ', 1);
INSERT INTO `srbase_forum_perm_groups` VALUES (0, 0, 'POST', 1);
INSERT INTO `srbase_forum_perm_groups` VALUES (0, 0, 'REPLY', 1);
INSERT INTO `srbase_forum_perm_groups` VALUES (0, 0, 'DELETE_OWN', 1);
INSERT INTO `srbase_forum_perm_groups` VALUES (0, 0, 'DELETE', 0);
INSERT INTO `srbase_forum_perm_groups` VALUES (0, 0, 'EDIT_OWN', 1);
INSERT INTO `srbase_forum_perm_groups` VALUES (0, 0, 'EDIT', 0);

#
# Table structure for table `srbase_forum_groups`
#

DROP TABLE IF EXISTS `srbase_forum_groups`;
CREATE TABLE `srbase_forum_groups` (
  `group_id` int(11) unsigned NOT NULL auto_increment,
  `group_name` varchar(25) NOT NULL default '',
  `group_desc` varchar(255) NOT NULL default '',
  `ingame` tinyint(3) NOT NULL default -1,
  PRIMARY KEY  (`group_id`)
) TYPE=MyISAM AUTO_INCREMENT=2;

INSERT INTO `srbase_forum_groups` VALUES (1, 'Users', 'Default user group for new users. It is a superglobal group', 0);

#
# Table structure for table `srbase_forum_groups_users`
#

DROP TABLE IF EXISTS `srbase_forum_group_users`;
CREATE TABLE `srbase_forum_group_users` (
  `group_id` int(11) unsigned NOT NULL ,
  `user_id` int(11) unsigned NOT NULL,
  `group_leader` tinyint(1) unsigned NOT NULL default 0,
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_leader` (`group_leader`)
) TYPE=MyISAM AUTO_INCREMENT=1;

INSERT INTO `srbase_forum_group_users` VALUES (1, 1, 0);

#
# Table structure for table `srbase_forum_privmsgs`
#

DROP TABLE IF EXISTS `srbase_forum_privmsgs`;
CREATE TABLE `srbase_forum_privmsgs` (
  `privmsg_id` int(11) unsigned NOT NULL auto_increment,
  `privmsg_title` varchar(25) NOT NULL default '',
  `privmsg_text` text NOT NULL,
  `privmsg_time` int(11) NOT NULL default 0,
  `privmsg_read` tinyint(1) NOT NULL default 0,
  `privmsg_replied` tinyint(1) NOT NULL default 0,
  `privmsg_from` int(11) NOT NULL default '',
  `privmsg_to` int(11) NOT NULL default '',
  `ingame` tinyint(3) NOT NULL default -1,
  PRIMARY KEY  (`privmsg_id`)
) TYPE=MyISAM AUTO_INCREMENT=1;

#
# Table structure for table `srbase_forum_privmsgs`
#

DROP TABLE IF EXISTS `srbase_forum_config`;
CREATE TABLE `srbase_forum_config` (
	`configname` varchar(50) NOT NULL default '',
	`configvalue` varchar(50) NOT NULL default '',
	`ingame` tinyint(3) NOT NULL default -1,
  KEY `configname` (`configname`),
  KEY `configvalue` (`configvalue`)
) TYPE=MyISAM AUTO_INCREMENT=1;

# Table structure for table `srbase_forum_poll`
#
# NOT SUPPORTED YET

#
# Table structure for table `srbase_forum_poll_options`
#
# NOT SUPPORTED YET

#
# Table structure for table `srbase_forum_poll_votes`
#
# NOT SUPPORTED YET

#
# Table structure for table `srbase_forum_bans`
#
# NOT SUPPORTED YET


