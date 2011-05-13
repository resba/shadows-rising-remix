<?php /* Smarty version 2.6.6, created on 2011-05-12 19:41:54
         compiled from blocks/combat_results.tpl.html */ ?>
<!--Start: Combat Results Block-->

<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['template_combat_vars']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

<div>

<br />Your Health: <span style="color: lightgreen;"><?php echo $this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['char_health']; ?>
</span><br />
Creature's Health: <span style="color: orange;"><?php echo $this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['creat_health']; ?>
</span><br />

<?php if ($this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['char_stats']['damage'] > 0 && $this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['char_stats']['critical'] > 0): ?>

	You scored a <span style="color: green;">CRITICAL HIT</span> doing <span style="color: blue;"><?php echo $this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['char_stats']['damage']; ?>
</span> damage.<br />

<?php elseif ($this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['char_stats']['damage'] > 0): ?>

	You have struck the creature doing <span style="color: blue;"><?php echo $this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['char_stats']['damage']; ?>
</span> damage.<br />

<?php elseif ($this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['char_stats']['nohit'] == 'true'): ?>

	You missed and did no damage!<br />

<?php endif; ?>

<?php if ($this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['creat_stats']['damage'] > 0): ?>

	The <span style="color: red;"><?php echo $this->_tpl_vars['creature']['name']; ?>
</span> hit you for <span style="color: blue;"><?php echo $this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['creat_stats']['damage']; ?>
</span> damage.<br />

<?php elseif ($this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['creat_stats']['nohit'] == 'true'): ?>

	The <span style="color: red;"><?php echo $this->_tpl_vars['creature']['name']; ?>
</span> missed and did no damage!<br />

<?php endif; ?>

<?php if ($this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['char_stats']['victory'] == 'true'): ?>

	<br />You defeated the <span style="color: red;"><?php echo $this->_tpl_vars['creature']['name']; ?>
</span>!!!<br />
	<br />You search the <span style="color: red;"><?php echo $this->_tpl_vars['creature']['name']; ?>
</span>'s body and discover <span style="color: yellow;"><?php echo $this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['cash_award']; ?>
</span> Gold!<br />
	You gain <span style="color: green;"><?php echo $this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['exp_award']; ?>
</span> Experience!

<?php endif; ?>

<?php if ($this->_tpl_vars['template_combat_vars'][$this->_sections['i']['index']]['char_stats']['defeat'] == 'true'): ?>

	<br />You have been defeated by the <span style="color: red;"><?php echo $this->_tpl_vars['creature']['name']; ?>
</span>!!!

<?php endif; ?>

</div>

<?php endfor; endif; ?>

<!--End: Combat Results Block-->