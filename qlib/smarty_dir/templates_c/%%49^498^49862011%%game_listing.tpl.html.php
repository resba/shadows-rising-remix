<?php /* Smarty version 2.6.6, created on 2011-05-12 19:35:25
         compiled from /home/resbahco/public_html/lab/rpg/qcms/modules/Game_Index/templates/game_listing.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', '/home/resbahco/public_html/lab/rpg/qcms/modules/Game_Index/templates/game_listing.tpl.html', 20, false),array('modifier', 'date_format', '/home/resbahco/public_html/lab/rpg/qcms/modules/Game_Index/templates/game_listing.tpl.html', 21, false),)), $this); ?>
<div style="text-align: center">
<table cellspacing="0" width="75%" class="default" style="text-align: left; padding: 2px;">
	<tr>
		<th>Game Index</th>
	</tr>
	<tr>
		<td>Game Name</td>
		<td>Type</td>
		<td>Start Date</td>
		<td>Player Count</td>
		<td>Location Count</td>
		<td>Status</td>
		<td>Action</td>
	</tr>
	
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['gameindex']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td><?php echo $this->_tpl_vars['gameindex'][$this->_sections['i']['index']]['name']; ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['gameindex'][$this->_sections['i']['index']]['type'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['gameindex'][$this->_sections['i']['index']]['start_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
		<td><?php echo $this->_tpl_vars['gameindex'][$this->_sections['i']['index']]['player_count']; ?>
</td>
		<td><?php echo $this->_tpl_vars['gameindex'][$this->_sections['i']['index']]['location_count']; ?>
</td>
		<?php if ($this->_tpl_vars['gameindex'][$this->_sections['i']['index']]['paused'] == 1): ?>
		    <td><i>Paused</i></td>
		<?php else: ?>
		    <td><b>Active</b></td>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['gameindex'][$this->_sections['i']['index']]['showlink'] == 'true'): ?>
			<td><a href="<?php echo $this->_tpl_vars['gameindex'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['gameindex'][$this->_sections['i']['index']]['link_name']; ?>
</a></td>
		<?php else: ?>
			<td><em>Not Logged In</em></td>
		<?php endif; ?>
	</tr>

<?php endfor; endif; ?>

</table>
</div>

<div style="text-align: left;">

<br /><br /><br /><br />

You are viewing the Game_Index module of Q-CMS. This module for Shadows Rising lists all games available on this server. This is the second test of the module code for Q-CMS. Modules are separate pages to be displayed within the CMS. You can create and add modules at any time - just add to the database with a new id, and create a link for that id, similar to the one used here for Game List.

</div>