<?php /* Smarty version 2.6.6, created on 2011-05-12 19:37:16
         compiled from mapset_menu.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_top.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<p>
<b>MapSet Menu</b>
<br />
<br />
Please select the map you wish to use for the current game. Note that altering maps during gameplay will likely cause numerous problems - so complete this before starting a game.
<br /><br />
<form method="post" action="mapset.php" name="mapset_form" id="mapset_form">
<input type="hidden" name="op" value="setmap" />
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['allmaps']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<input type="radio" name="mpname" value="<?php echo $this->_tpl_vars['allmaps'][$this->_sections['i']['index']]['name']; ?>
" /> <?php echo $this->_tpl_vars['allmaps'][$this->_sections['i']['index']]['name']; ?>
 (<?php echo $this->_tpl_vars['allmaps'][$this->_sections['i']['index']]['width']; ?>
 x <?php echo $this->_tpl_vars['allmaps'][$this->_sections['i']['index']]['height']; ?>
) - <a href="mapgen.php?op=setmap&amp;name=<?php echo $this->_tpl_vars['allmaps'][$this->_sections['i']['index']]['name']; ?>
">Edit</a><br />
<?php endfor; endif; ?>
<br />
Are you sure your choice is correct? <input type="checkbox" name="mapset_sure" value="yes" />
<br /><br />
<input type="submit" value="Set Map!" />
</form>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_bottom.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>