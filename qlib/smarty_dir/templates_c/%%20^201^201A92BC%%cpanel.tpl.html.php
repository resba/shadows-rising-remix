<?php /* Smarty version 2.6.6, created on 2011-05-12 19:37:10
         compiled from cpanel.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_top.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
At present only a small number of Administrative Functions are available.
<br />
<br />
<a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/cpanel/mapgen.php">MapGen</a> (Terrain Map Editor/Generator)<br />
<a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/cpanel/mapset.php">MapSet</a> (Set an MapGen terrain map to be the Game's location map)

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_bottom.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>