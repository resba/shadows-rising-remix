<?php /* Smarty version 2.6.6, created on 2011-05-12 19:36:30
         compiled from character_name.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_top.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<p>
In order to play Shadows Rising you must first create your character. There are a number of steps in this process. Please consider each carefully before final submission of your character as you will be unable to change these details once the game has started unless you retire and then restart the game from the beginning.
<p>
<br />
<div>

<form method="post" action="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/character_create.php">
<input type="hidden" name="op" value="race" />
What is the name of your Character?<br />
<input type="text" name="char_name" value="" size="32" maxlength="32" />
<br /><br />
What sex is your character?<br />
Male <input type="radio" name="char_sex" value="male" checked="checked" /><br />
Female <input type="radio" name="char_sex" value="female" />
<br /><br />
<input type="reset" name="reset" value="Reset" /><input type="submit" name="submit" value="Submit" />
</form>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_bottom.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>