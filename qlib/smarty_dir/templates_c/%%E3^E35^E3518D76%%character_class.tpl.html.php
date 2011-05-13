<?php /* Smarty version 2.6.6, created on 2011-05-12 19:36:39
         compiled from character_class.tpl.html */ ?>
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
/core/character_create.php" id="class_choice">
<input type="hidden" name="op" value="class2" />

To which Class does your character belong?<br /><br />

<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['char_classes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	
	<table cellpadding="0" cellspacing="0" class="invisible" style="border: 1px solid #c0c0c0; width: 500px;">
		<tr>
			<td style="width: 20%; vertical-align: center; text-align: center;">
				<?php echo $this->_tpl_vars['char_classes'][$this->_sections['i']['index']]['name']; ?>
<br /><input type="radio" name="char_class" value="<?php echo $this->_tpl_vars['char_classes'][$this->_sections['i']['index']]['class_id']; ?>
" />
			</td>
			<td style="width: 60%; vertical-align: top; text-align: center;">
				<?php echo $this->_tpl_vars['char_classes'][$this->_sections['i']['index']]['description']; ?>

			</td>
			<td style="width: 20%; vertical-align: top; text-align: center;">
				HP (Lvl 1): <?php echo $this->_tpl_vars['char_classes'][$this->_sections['i']['index']]['start_hp']; ?>

			</td>
		</tr>
	</table>
	<br />

<?php endfor; endif; ?>

<br />
<input type="reset" name="reset" value="Reset" /><input type="submit" name="submit" value="Submit" />
</form>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_bottom.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>