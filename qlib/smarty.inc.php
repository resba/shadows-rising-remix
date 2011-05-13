<?php

// load Smarty library
require_once($CONFIG['gameroot']."/qlib/thirdparty/smarty/libs/Smarty.class.php");

// Quantum Star Class to preset directory paths for each new instance

class Q_Smarty extends Smarty {

	// Class Constructor - enables setting of the theme location where templates exist
	// should be adjusted later to account for changes in themes while maintaining same cache if possible

	var $gameroot;
	$gameroot = $GLOBALS['CONFIG']['gameroot'];

	function Q_Smarty($theme="Shadows_Rising_Default")
	{
		$this->Smarty();
		$this->template_dir = $gameroot . "qcms/themes/$theme/templates/";
		$this->compile_dir = $gameroot . "qlib/smarty_dir/templates_c/";
		$this->config_dir = $gameroot . "qlib/smarty_dir/configs/";
		$this->cache_dir = $gameroot . "qlib/smarty_dir/cache/";
		$this->caching = false;
		$this->assign('app_name','Shadows Rising RPG Game Engine');
	}
}

?> 