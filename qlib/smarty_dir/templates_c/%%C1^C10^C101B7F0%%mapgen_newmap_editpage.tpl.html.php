<?php /* Smarty version 2.6.6, created on 2011-05-12 19:37:38
         compiled from mapgen_newmap_editpage.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mapgen_top.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div>
The terrain map editor allows users to select individual tiles (you may select many at once) and assign a new terrain type to each. There are currently a limited selection tiles (this is temporary - we have dozens of compatible tiles which will eventually enable adding of multiple terrain types, rivers, paths, cities, etc). Simply select the tiles you wish to change, choose a new terrain type, and submit. On submission the changes are stored to the database and the editing page will refresh showing the results of your changes. All changes are fully stored on submission - you may return to edit at any time after. Maps are not limited in size - so large maps will take time to edit!
<br /><br />
</div>

<!-- Note: We use the calculated coordinates to uniquely name all <img> and <input> tags within each table cell - this allows some javascript we'll later load to aggregate all changes to all tile-spaces, alter all tile-space input areas, and collectively send the data to a save script in PHP - see what's used for merchant.php for instance -->

<form method="post" action="mapgen.php" name="tile_img_selection">
<input type="hidden" name="op" value="save_tilechanges" />
<input type="hidden" name="name" value="<?php echo $this->_tpl_vars['mp_name']; ?>
" />

<table cellspacing="0" cellpadding="0">

<?php echo $this->_tpl_vars['tile_table_output']; ?>


</table>


<div>
<br /><br />
Select a new terrain type for the selected tiles:
<select name="tile_img">
<option value="grass_0.gif" selected="selected">Grassland</option>
<option value="mountain_0.gif">Mountains</option>
<option value="forest_0.gif">Forest</option>
<option value="ocean_0.gif">Ocean</option>
<option value="dirt_0.gif">Earth</option>
<option value="barren_0.gif">Barren Earth</option>
</select>
<input type="submit" name="submit" value="Submit" />
</form>

</div>

<div>
<br /><br />
<a href="mapgen.php?op=edit_savedmap&amp;name=<?php echo $this->_tpl_vars['mp_name']; ?>
">Refresh This Map?</a>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_bottom.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>