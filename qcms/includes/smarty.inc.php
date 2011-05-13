<?php

// load Smarty library
require_once($CONFIG['gameroot']."/qlib/thirdparty/smarty/libs/Smarty.class.php");

// Quantum Star Class to preset directory paths for each new instance

class Q_Smarty extends Smarty {

	// Class Constructor - enables setting of the theme location where templates exist
	// should be adjusted later to account for changes in themes while maintaining same cache if possible

	var $gameroot;

	function Q_Smarty($theme="Shadows_Rising_Default")
	{
		$this->gameroot = $GLOBALS['CONFIG']['gameroot'];
		$this->Smarty();
		$this->template_dir = $this->gameroot . "/qcms/themes/$theme/templates/";
		$this->compile_dir = $this->gameroot . "/qlib/smarty_dir/templates_c/";
		$this->config_dir = $this->gameroot . "/qlib/smarty_dir/configs/";
		$this->cache_dir = $this->gameroot . "/qlib/smarty_dir/cache/";
		$this->caching = false;
		$this->assign('app_name','Shadows Rising RPG Engine');
		// standard configuration variables as set by user
		$this->assign("server_name", $GLOBALS['CONFIG']['server_name']);
		$this->assign("url_prefix", $GLOBALS['CONFIG']['url_prefix']);
		$this->assign("code_base", $GLOBALS['CONFIG']['code_base']);
		$this->assign("link_forums", $GLOBALS['CONFIG']['link_forums']);
		$this->assign("admin_mail", $GLOBALS['CONFIG']['admin_mail']);
	}
}

?> 