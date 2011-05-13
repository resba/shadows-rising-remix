------------------------------------------------------------------
-- My2Pg 1.32 translated dump
--
------------------------------------------------------------------

BEGIN;




--
-- Sequences for table SRBASE_SRMODULE_CLASSES
--

CREATE SEQUENCE srbase_srmodule_classes_clas;

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
-- Table structure for table srbase_srmodule_classes
--


CREATE TABLE "srbase_srmodule_classes" (
  "class_id" INT4 DEFAULT nextval('srbase_srmodule_classes_clas'),
  "name" varchar(64) DEFAULT '',
  "description" TEXT DEFAULT '' NOT NULL,
  "start_hp" INT4  NOT NULL DEFAULT '0',
  "skill_points" INT4  NOT NULL DEFAULT '0',
  "rank1" varchar(32) DEFAULT '',
  "rank2" varchar(32) DEFAULT '',
  "rank3" varchar(32) DEFAULT '',
  "rank4" varchar(32) DEFAULT '',
  "rank5" varchar(32) DEFAULT '',
  "rank6" varchar(32) DEFAULT '',
  "rank7" varchar(32) DEFAULT '',
  "rank8" varchar(32) DEFAULT '',
  "rank9" varchar(32) DEFAULT '',
  "rank10" varchar(32) DEFAULT ''
);

--
-- Dumping data for table srbase_srmodule_classes
--

INSERT INTO "srbase_srmodule_classes" VALUES (1, 'Fighter', 'Fighter live for one thing only - to fight. Whether in wars, mercenary jobs or bar brawls, these are the last people you ever want to encounter!', 20, 2, 'Novice', 'Initiate', 'Brawler', 'Guard', 'Soldier', 'Warrior', 'Master', 'Commander', 'General', 'Warlord');
INSERT INTO "srbase_srmodule_classes" VALUES (2, 'Wizard', 'Wizards are masters of structured magic. Their powers are generated through often complex spells and pre-spelled amulets. Generally weaker than more muscle-bound classes, although Generals are rarely stupid enough to go to war without at least one.', 12, 2, 'Novice', 'Student', 'Apprentice', 'Qualified', 'Teacher', 'Master', 'Low Wizard', 'Middle Wizard', 'High Wizard', 'Arch Wizard');

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_creatures
--




--
-- Sequences for table SRBASE_SRMODULE_CREATURES
--

CREATE SEQUENCE srbase_srmodule_creatures_cr;

CREATE TABLE "srbase_srmodule_creatures" (
  "creature_id" INT4 DEFAULT nextval('srbase_srmodule_creatures_cr'),
  "access_flag" INT2  NOT NULL DEFAULT '1',
  "name" varchar(64) DEFAULT 'Unidentified Menace',
  "description" TEXT DEFAULT '' NOT NULL,
  "encounter_level" INT2  NOT NULL DEFAULT '1',
  "level" INT2  NOT NULL DEFAULT '1',
  "size" varchar(16) DEFAULT 'Medium',
  "type" varchar(16) DEFAULT 'Normal',
  "health" INT4  NOT NULL DEFAULT '10',
  "armour_class" INT4  NOT NULL DEFAULT '0',
  "weapon_id" INT4  NOT NULL DEFAULT '0',
  "armour_id" INT4  NOT NULL DEFAULT '0',
  "str" INT2  NOT NULL DEFAULT '0',
  "dex" INT2  NOT NULL DEFAULT '0',
  "con" INT2  NOT NULL DEFAULT '0',
  "intel" INT2  NOT NULL DEFAULT '0',
  "wis" INT2  NOT NULL DEFAULT '0',
  "cha" INT2  NOT NULL DEFAULT '0'
);

--
-- "Dumping" data for table srbase_srmodule_creatures
--

INSERT INTO "srbase_srmodule_creatures" VALUES (1, 1, 'Giant Kangaroo', 'A fairly common irritation on the plains of Nemedia - approach carefully as these creatures use a mystical combat technique termed kickpunching...', 1, 1, 'Large', 'Normal', 25, 0, 0, 0, 10, 5, 5, 2, 2, 2);

-- --------------------------------------------------------

--
-- "Table" structure for table srbase_srmodule_items
--


CREATE TABLE "srbase_srmodule_items" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "alignment" varchar(7) DEFAULT 'neutral',
  "equip_penalty" varchar(4) DEFAULT 'none',
  "penalty_amount" INT2  NOT NULL DEFAULT '0',
  "max_damage" INT2  NOT NULL DEFAULT '0',
  "min_critical" INT2  NOT NULL DEFAULT '0',
  "max_critical" INT2  NOT NULL DEFAULT '0',
  "critical_multiplier" INT2  NOT NULL DEFAULT '0',
  "handle" varchar(32) DEFAULT 'single'
);

--
-- Dumping data for table srbase_srmodule_items
--

INSERT INTO "srbase_srmodule_items" VALUES (1, 'weapon', 'Ancient Rusty Dagger', 'Found buried in the thatch of a 90 year old Human\'s hut, this Ancient Rusty Dagger has seen better days than today!', 1, 10, 1, 0, 'neutral', 'none', 0, 4, 19, 20, 2, 'single');
INSERT INTO "srbase_srmodule_items" VALUES (2, 'weapon', 'Cracked Wooden Staff', 'Looks like that 90 year-old Human kept a few ill-kept weapons in his thatch!', 1, 10, 1, 0, 'neutral', 'none', 0, 6, 19, 20, 3, 'double');

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_belts
--


CREATE TABLE "srbase_srmodule_items_belts" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "alignment" varchar(7) DEFAULT 'neutral',
  "equip_penalty" varchar(4) DEFAULT 'none',
  "penalty_amount" INT2  NOT NULL DEFAULT '0',
  "effect" varchar(32) DEFAULT 'nothing',
  "effect_type" varchar(32) DEFAULT 'none',
  "effect_amount" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_items_belts
--

INSERT INTO "srbase_srmodule_items_belts" VALUES (1, 'belt', 'Old Mans Belt', 'Yet another artifact from everyones favourite human - his old leather belt!', 1, 15, 1, 0, 'neutral', 'none', 0, 'attribute', 'con', 1);

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_bracers
--


CREATE TABLE "srbase_srmodule_items_bracers" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "alignment" varchar(7) DEFAULT 'neutral',
  "equip_penalty" varchar(4) DEFAULT 'none',
  "penalty_amount" INT2  NOT NULL DEFAULT '0',
  "effect" varchar(32) DEFAULT 'nothing',
  "effect_type" varchar(32) DEFAULT 'none',
  "effect_amount" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_items_bracers
--

INSERT INTO "srbase_srmodule_items_bracers" VALUES (1, 'bracer', 'Leather Bracers', 'Serviceable if not exactly polished new - these bracers offer some protection against damage to your forearms.', 1, 45, 1, 0, 'neutral', 'none', 0, 'armour', 'natural', 1);

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_cloaks
--


CREATE TABLE "srbase_srmodule_items_cloaks" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "alignment" varchar(7) DEFAULT 'neutral',
  "equip_penalty" varchar(4) DEFAULT 'none',
  "penalty_amount" INT2  NOT NULL DEFAULT '0',
  "effect" varchar(32) DEFAULT 'nothing',
  "effect_type" varchar(32) DEFAULT 'none',
  "effect_amount" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_items_cloaks
--

INSERT INTO "srbase_srmodule_items_cloaks" VALUES (1, 'cloak', 'Cloak of the Acrobats', 'Purchased from a Bard who claimed he needed the gold to retire, he depended on this cloak to perform amazing acrobatic feats.', 1, 75, 1, 0, 'neutral', 'none', 0, 'attribute', 'dex', 1);

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_drugs
--


CREATE TABLE "srbase_srmodule_items_drugs" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "effect" varchar(32) DEFAULT 'nothing',
  "effect_type" varchar(32) DEFAULT 'none',
  "effect_amount" INT2  NOT NULL DEFAULT '0',
  "physical" varchar(32) DEFAULT 'nothing',
  "physical_amount" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_items_drugs
--


-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_gauntlets
--


CREATE TABLE "srbase_srmodule_items_gauntlets" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "alignment" varchar(7) DEFAULT 'neutral',
  "equip_penalty" varchar(4) DEFAULT 'none',
  "penalty_amount" INT2  NOT NULL DEFAULT '0',
  "effect" varchar(32) DEFAULT 'nothing',
  "effect_type" varchar(32) DEFAULT 'none',
  "effect_amount" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_items_gauntlets
--


-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_headgear
--


CREATE TABLE "srbase_srmodule_items_headgear" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "alignment" varchar(7) DEFAULT 'neutral',
  "equip_penalty" varchar(4) DEFAULT 'none',
  "penalty_amount" INT2  NOT NULL DEFAULT '0',
  "effect" varchar(32) DEFAULT 'nothing',
  "effect_type" varchar(32) DEFAULT 'none',
  "effect_amount" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_items_headgear
--


-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_neckwear
--


CREATE TABLE "srbase_srmodule_items_neckwear" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "alignment" varchar(7) DEFAULT 'neutral',
  "equip_penalty" varchar(4) DEFAULT 'none',
  "penalty_amount" INT2  NOT NULL DEFAULT '0',
  "effect" varchar(32) DEFAULT 'nothing',
  "effect_type" varchar(32) DEFAULT 'none',
  "effect_amount" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_items_neckwear
--


-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_rings
--


CREATE TABLE "srbase_srmodule_items_rings" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "alignment" varchar(7) DEFAULT 'neutral',
  "equip_penalty" varchar(4) DEFAULT 'none',
  "penalty_amount" INT2  NOT NULL DEFAULT '0',
  "effect" varchar(32) DEFAULT 'nothing',
  "effect_type" varchar(32) DEFAULT 'none',
  "effect_amount" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_items_rings
--

INSERT INTO "srbase_srmodule_items_rings" VALUES (1, 'ring', 'Ring of Strength', 'A common enough item employed by the Fighter Class in particular. This ring increases a character\\\'s strength and therefore damage dealt by any weapon.', 1, 50, 1, 0, 'neutral', 'none', 0, 'attribute', 'str', 1);

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_texts
--


CREATE TABLE "srbase_srmodule_items_texts" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_items_texts
--


-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_tools
--


CREATE TABLE "srbase_srmodule_items_tools" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "skill_id" INT4  NOT NULL DEFAULT '0',
  "skill_amount" INT2  NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_items_tools
--


-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_items_weapons
--


CREATE TABLE "srbase_srmodule_items_weapons" (
  "item_id" INT4  NOT NULL DEFAULT '0',
  "type" varchar(32) DEFAULT 'miscellaneous',
  "name" varchar(64) DEFAULT 'Unidentified',
  "description" TEXT DEFAULT '' NOT NULL,
  "level" INT2  NOT NULL DEFAULT '1',
  "cost" INT4  NOT NULL DEFAULT '10',
  "weight" INT2  NOT NULL DEFAULT '1',
  "class_special" INT2  NOT NULL DEFAULT '0',
  "alignment" varchar(7) DEFAULT 'neutral',
  "equip_penalty" varchar(4) DEFAULT 'none',
  "penalty_amount" INT2  NOT NULL DEFAULT '0',
  "max_damage" INT2  NOT NULL DEFAULT '0',
  "min_critical" INT2  NOT NULL DEFAULT '0',
  "max_critical" INT2  NOT NULL DEFAULT '0',
  "critical_multiplier" INT2  NOT NULL DEFAULT '0',
  "handle" varchar(32) DEFAULT 'single'
);

--
-- Dumping data for table srbase_srmodule_items_weapons
--

INSERT INTO "srbase_srmodule_items_weapons" VALUES (1, 'weapon', 'Ancient Rusty Dagger', 'Found buried in the thatch of a 90 year old Humans hut, this Ancient Rusty Dagger has seen better days than today!', 1, 10, 1, 0, 'neutral', 'none', 0, 4, 19, 20, 2, 'single');
INSERT INTO "srbase_srmodule_items_weapons" VALUES (2, 'weapon', 'Cracked Wooden Staff', 'Looks like that 90 year-old Human kept a few ill-kept weapons in his thatch!', 1, 10, 1, 0, 'neutral', 'none', 0, 6, 19, 20, 3, 'double');

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_itemtypes
--




--
-- Sequences for table SRBASE_SRMODULE_ITEMTYPES
--

CREATE SEQUENCE srbase_srmodule_itemtypes_ty;

CREATE TABLE "srbase_srmodule_itemtypes" (
  "type_id" INT4 DEFAULT nextval('srbase_srmodule_itemtypes_ty'),
  "type" varchar(32) DEFAULT '',
  "db_postfix" varchar(32) DEFAULT 'misc'
);

--
-- Dumping data for table srbase_srmodule_itemtypes
--

INSERT INTO "srbase_srmodule_itemtypes" VALUES (1, 'weapon', 'weapons');
INSERT INTO "srbase_srmodule_itemtypes" VALUES (2, 'amulet', 'neckwear');
INSERT INTO "srbase_srmodule_itemtypes" VALUES (3, 'belt', 'belts');
INSERT INTO "srbase_srmodule_itemtypes" VALUES (4, 'bracer', 'bracers');
INSERT INTO "srbase_srmodule_itemtypes" VALUES (5, 'cloak', 'cloaks');
INSERT INTO "srbase_srmodule_itemtypes" VALUES (6, 'gauntlet', 'gauntlets');
INSERT INTO "srbase_srmodule_itemtypes" VALUES (7, 'drug', 'drugs');
INSERT INTO "srbase_srmodule_itemtypes" VALUES (8, 'headgear', 'headgear');
INSERT INTO "srbase_srmodule_itemtypes" VALUES (9, 'ring', 'rings');
INSERT INTO "srbase_srmodule_itemtypes" VALUES (10, 'tool', 'tools');
INSERT INTO "srbase_srmodule_itemtypes" VALUES (11, 'text', 'texts');

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_races
--




--
-- Sequences for table SRBASE_SRMODULE_RACES
--

CREATE SEQUENCE srbase_srmodule_races_race_i;

CREATE TABLE "srbase_srmodule_races" (
  "race_id" INT4 DEFAULT nextval('srbase_srmodule_races_race_i'),
  "name" varchar(64) DEFAULT '',
  "preferred_class" INT4  NOT NULL DEFAULT '0',
  "description" TEXT DEFAULT '' NOT NULL,
  "mod_str" INT4 NOT NULL DEFAULT '0',
  "mod_dex" INT4 NOT NULL DEFAULT '0',
  "mod_con" INT4 NOT NULL DEFAULT '0',
  "mod_int" INT4 NOT NULL DEFAULT '0',
  "mod_wis" INT4 NOT NULL DEFAULT '0',
  "mod_cha" INT4 NOT NULL DEFAULT '0'
);

--
-- Dumping data for table srbase_srmodule_races
--

INSERT INTO "srbase_srmodule_races" VALUES (1, 'Human', 0, 'Humans are adept at adapting to their environments and inventing novel solutions to challenges they face. They progress in skill at a faster rate than most other races and receive no penalty (also no bonus) to the base attributes.', 0, 0, 0, 0, 0, 0);
INSERT INTO "srbase_srmodule_races" VALUES (2, 'Elf', 0, 'The Elves are one of the Eldar races, who put a great deal of faith in what they term their "superior heritage". They live predominantly in heavily forested woodland. Their physical bodies are more frail than a humans, but is compensated by a near superhuman speed of movement.', 0, 2, -2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_maps
--




--
-- Sequences for table SRBASE_SRMODULE_MAPS
--

CREATE SEQUENCE srbase_srmodule_maps_map_id_;

CREATE TABLE "srbase_srmodule_maps" (
  "map_id" INT4 DEFAULT nextval('srbase_srmodule_maps_map_id_'),
  "name" varchar(32) DEFAULT 'unnamed',
  "height" INT2  NOT NULL DEFAULT '0',
  "width" INT2  NOT NULL DEFAULT '0',
  "num_tiles" INT4  NOT NULL DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table srbase_srmodule_maptiles
--




--
-- Sequences for table SRBASE_SRMODULE_MAPTILES
--

CREATE SEQUENCE srbase_srmodule_maptiles_til;

CREATE TABLE "srbase_srmodule_maptiles" (
  "tile_id" INT4 DEFAULT nextval('srbase_srmodule_maptiles_til'),
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
-- Indexes for table SRBASE_SRMODULE_ITEMS_BRACERS
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_bracers_index ON "srbase_srmodule_items_bracers" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_MAPTILES
--

CREATE UNIQUE INDEX tile_id_srbase_srmodule_maptiles_index ON "srbase_srmodule_maptiles" ("tile_id");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS_BELTS
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_belts_index ON "srbase_srmodule_items_belts" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_index ON "srbase_srmodule_items" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS_CLOAKS
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_cloaks_index ON "srbase_srmodule_items_cloaks" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_CLASSES
--

CREATE UNIQUE INDEX class_id_srbase_srmodule_classes_index ON "srbase_srmodule_classes" ("class_id","name");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS_WEAPONS
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_weapons_index ON "srbase_srmodule_items_weapons" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS_DRUGS
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_drugs_index ON "srbase_srmodule_items_drugs" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_MAPS
--

CREATE UNIQUE INDEX map_id_srbase_srmodule_maps_index ON "srbase_srmodule_maps" ("map_id","name");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS_TEXTS
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_texts_index ON "srbase_srmodule_items_texts" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_ITEMTYPES
--

CREATE UNIQUE INDEX type_id_srbase_srmodule_itemtypes_index ON "srbase_srmodule_itemtypes" ("type_id","type");

--
-- Indexes for table SRBASE_SRMODULE_CREATURES
--

CREATE UNIQUE INDEX creature_id_srbase_srmodule_creatures_index ON "srbase_srmodule_creatures" ("creature_id");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS_TOOLS
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_tools_index ON "srbase_srmodule_items_tools" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS_GAUNTLETS
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_gauntlets_index ON "srbase_srmodule_items_gauntlets" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS_RINGS
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_rings_index ON "srbase_srmodule_items_rings" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS_HEADGEAR
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_headgear_index ON "srbase_srmodule_items_headgear" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_ITEMS_NECKWEAR
--

CREATE UNIQUE INDEX item_id_srbase_srmodule_items_neckwear_index ON "srbase_srmodule_items_neckwear" ("item_id","name");

--
-- Indexes for table SRBASE_SRMODULE_RACES
--

CREATE UNIQUE INDEX race_id_srbase_srmodule_races_index ON "srbase_srmodule_races" ("race_id","name");

--
-- Sequences for table SRBASE_SRMODULE_ITEMTYPES
--

SELECT SETVAL('srbase_srmodule_itemtypes_ty',(select case when max("type_id")>0 then max("type_id")+1 else 1 end from "srbase_srmodule_itemtypes"));

--
-- Sequences for table SRBASE_SRMODULE_CREATURES
--

SELECT SETVAL('srbase_srmodule_creatures_cr',(select case when max("creature_id")>0 then max("creature_id")+1 else 1 end from "srbase_srmodule_creatures"));

--
-- Sequences for table SRBASE_SRMODULE_CLASSES
--

SELECT SETVAL('srbase_srmodule_classes_clas',(select case when max("class_id")>0 then max("class_id")+1 else 1 end from "srbase_srmodule_classes"));

--
-- Sequences for table SRBASE_SRMODULE_RACES
--

SELECT SETVAL('srbase_srmodule_races_race_i',(select case when max("race_id")>0 then max("race_id")+1 else 1 end from "srbase_srmodule_races"));

--
-- Sequences for table SRBASE_SRMODULE_MAPTILES
--

SELECT SETVAL('srbase_srmodule_maptiles_til',(select case when max("tile_id")>0 then max("tile_id")+1 else 1 end from "srbase_srmodule_maptiles"));

--
-- Sequences for table SRBASE_SRMODULE_MAPS
--

SELECT SETVAL('srbase_srmodule_maps_map_id_',(select case when max("map_id")>0 then max("map_id")+1 else 1 end from "srbase_srmodule_maps"));

COMMIT;
