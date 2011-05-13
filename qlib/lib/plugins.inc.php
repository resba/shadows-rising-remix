<?php

/*
Copyright (c) 2004 Padraic Brady
Governed by the GNU General Public License
*/

// this is a small outline of the upcoming plugin system - yep, we're finally reaching a point where we'll be capable of adding some flesh to our skeletal structure.

class Plugin_Modules {


	function Plugin_Modules {
		// definitions and default for all class variables
	}

	// function to validate the plugin prior to use
	function validate_plugin {
		// perform a number of checks to ensure module can be used
		is_installed()
		is_active()
		check_version()
		check_dependencies()
	}

	function is_installed {
		// check to ensure module installed to DB
		// check plugin file exists
	}

	function is_active {
		// check plugin settings are available
		// check plugin is activated
	}

	function check_version {
		// check the version of the module
		// check if filemtime()/version has changed since installation - if so, update
	}

	function check_dependencies() {
		// plugin definition will include a list of dependencies on certain other modules of a specific version
	}

	// used within game-engine files to include any plugins, and plugin processes which are defined at that
	// location in the game engine files.
	// each plugin should contain predefined hook locations - this function will exercise the processes
	// associated with those locations
	function hook() {
		// grab all hooks from database for a specified location in game engine
		// determine which hooks to process - all or one specific hook
		// check the plugin associated with the hook(s) is valid before processing
		validate_plugin()
		// include the plugin file
		// from the hook DB data, make a call to the function name for the hook(s)
	}

	function eventhook() {
		// as above only for events
	}

	function install_plugin() {
		// install the specified plugin - assumes the plugin dev has added an installation function
		// to the plugin file to generate any settings, or hooks their plugin will use.
	}

	function append_hook() {
		// add a hook to the database
	}

	function append_eventhook() {
		// adds a hook. Event Hooks are in respect of actual events which occur during play. As opposed
		// to a constant addition. Constants are always there (temples, shops, portals), Events are
		// random/temporary (random encounter, temporary existence of NPCs)
	}

	function drop_hook() {
		// delete a hook from the database
	}

	function drop_eventhook() {
		// as above - only for event hooks
	}

	function fetch_plugin_settings() {
		// fetch the settings for a module
	}

	function set_plugin_setting() {
		// set a setting to a new value for a module
	}

	function fetch_plugin_uservalues() {
		// each user as they encounter plugin processes will gather up variable for plugins to assess,
		// e.g. Player 1 has been cursed by a priest of the Dark Temple. Player 2 has not. To
		// differentiate the results, Player 1 will have a plugin uservalue of a certain type stored
		// on the database.

		// As an example of a dependency. Perhaps a separate plugin, say the Temple of Light, could use
		// this value to offer Player 1 a removal of the curse.
	}

	function set_plugin_uservalue() {
		// used within plugins to create, or alter some uservalue specific to a player
	}


	// DEV
	/*
	Being the nature of event, some will happen, some will not. A few extra will be added later to allow events be calculated/determined as occuring, as well as sorting out the priority in case more than one event appears valid at the same time (obviously they must with be queued or one chosen and the others discarded).
	*/

	function append_plugin_error() {
		// to offer some measure of recoverability, being as we must assume external users creating non
		// developer reviewed plugins will get it wrong on occassion, we will collect all non-fatal
		// errors for disclosure after processing all plugins.
		// hence no non-fatal error should produce a final system message blocking the whole game
	}

	function echo_plugin_errors() {
		// echo collected plugin errors (assuming none are fatal)
	}

}

?>