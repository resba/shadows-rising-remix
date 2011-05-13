<?php /* Smarty version 2.6.6, created on 2011-05-12 19:36:43
         compiled from character_skills.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "setskills_top.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div>

<form method="post" action="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/character_create.php" id="class_choice">
<input type="hidden" name="op" value="save_skills" />
<input type="hidden" name="skill_pts" id="skill_pts" value="<?php echo $this->_tpl_vars['character']['skill_points']; ?>
" />

Please assign your free skill points to the skills as listed below. Any skill points which remain unassigned will be carried forward until you next level up.<br /><br />

Your character currently has <span style="background-color: #ffffff; font-weight: bold; color: #000000; font-size: 10pt;" id="skill_pts_text">&nbsp;<?php echo $this->_tpl_vars['character']['skill_points']; ?>
&nbsp;</span> Skill points remaining.<br /><br />



	<table cellpadding="0" cellspacing="0" class="invisible" style="border: 1px solid #c0c0c0; width: 600px; border-bottom: 0px;">
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['char_skills']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<tr>
			<td style="vertical-align: center; text-align: left; border-bottom: 1px solid #c0c0c0;">
				<b style="font-size: 12pt;"><?php echo $this->_tpl_vars['char_skills'][$this->_sections['i']['index']]['skill_name']; ?>
</b><br /><br />
				<span style="background-color: #ffffff; font-weight: bold; color: #000000; font-size: 10pt;" id="skill_<?php echo $this->_tpl_vars['char_skills'][$this->_sections['i']['index']]['skill_id']; ?>
">&nbsp;0&nbsp;</span>
				<span style="font-size: 12pt;"><a href="javascript:incrementAllocatedPoints('skill_value_<?php echo $this->_tpl_vars['char_skills'][$this->_sections['i']['index']]['skill_id']; ?>
','skill_<?php echo $this->_tpl_vars['char_skills'][$this->_sections['i']['index']]['skill_id']; ?>
',<?php echo $this->_tpl_vars['character']['level']; ?>
)">&nbsp;&uArr;&nbsp;</a>/<a href="javascript:decrementAllocatedPoints('skill_value_<?php echo $this->_tpl_vars['char_skills'][$this->_sections['i']['index']]['skill_id']; ?>
','skill_<?php echo $this->_tpl_vars['char_skills'][$this->_sections['i']['index']]['skill_id']; ?>
',0,<?php echo $this->_tpl_vars['character']['skill_points']; ?>
)">&nbsp;&dArr;&nbsp;</a></span>
				<input type="hidden" value="0" name="skill_value_<?php echo $this->_tpl_vars['char_skills'][$this->_sections['i']['index']]['skill_id']; ?>
" id="skill_value_<?php echo $this->_tpl_vars['char_skills'][$this->_sections['i']['index']]['skill_id']; ?>
" />
			</td>
			<td style="vertical-align: top; text-align: left; border-bottom: 1px solid #c0c0c0; padding: 5px;">
				<?php echo $this->_tpl_vars['char_skills'][$this->_sections['i']['index']]['description']; ?>

			</td>
		</tr>
	<?php endfor; endif; ?>
	</table>
	<br />



<br />
<input type="submit" value="Submit" />
</form>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_bottom.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>