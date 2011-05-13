<?php /* Smarty version 2.6.6, created on 2011-05-12 19:37:20
         compiled from mapgen_newmap_details.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_top.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div>

In order to begin designing a new map, please enter some basic information regarding the map you intend creating:
<br /><br />
<form method="post" action="mapgen.php" id="mapgen_details">
<input type="hidden" name="op" value="save_details" />
Please enter the dimensions of the map in "number of tiles" for height and width. To more easily translate this into pixels, please note that all terrain tiles are 35px in height, and 24px in width.
<br /><br />
Height:&nbsp;<input type="text" name="mp_height" size="3" value="" maxlength="3" />
Width:&nbsp;<input type="text" name="mp_width" size="3" value="" maxlength="3" />
<br /><br />
Please enter a name by which you wish this map to be known:
<br /><br />
<input type="text" name="mp_name" value="" maxlength="32" />
<small>(All maps stored on database automatically for future editing/removal)</small>
<br /><br />
<input type="submit" name="mp_submit" value="Start Editing!" />
</form>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_bottom.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>