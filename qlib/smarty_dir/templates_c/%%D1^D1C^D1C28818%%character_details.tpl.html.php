<?php /* Smarty version 2.6.6, created on 2011-05-12 19:36:30
         compiled from blocks/character_details.tpl.html */ ?>
<!--Start Character Details Block-->
		<table cellspacing="0" class="invisible">
			<tr>
				<th colspan="2"><?php echo $this->_tpl_vars['character']['name']; ?>
</th>
			</tr>
			<tr>
				<td class="halfwidth">Race:</td>
				<td class="halfwidth2"><?php echo $this->_tpl_vars['character']['race_name']; ?>
 (<?php echo $this->_tpl_vars['character']['sex']; ?>
)</td>
			</tr>
			<tr>
				<td class="halfwidth">Class:</td>
				<td class="halfwidth2"><?php echo $this->_tpl_vars['character']['class_name']; ?>
</td>
			</tr>
			<tr>
				<td class="halfwidth">Rank:</td>
				<td class="halfwidth2"><?php echo $this->_tpl_vars['character']['rank_name']; ?>
</td>
			</tr>
			<tr>
				<td class="halfwidth">Level:</td>
				<td class="halfwidth2"><?php echo $this->_tpl_vars['character']['level']; ?>
</td>
			</tr>
			<tr>
				<td class="halfwidth">Hit Points:</td>
				<td class="halfwidth2"><?php echo $this->_tpl_vars['character']['hp']; ?>
</td>
			</tr>
			<tr>
				<td class="halfwidth">Exp:</td>
				<td class="halfwidth2"><?php echo $this->_tpl_vars['character']['exp']; ?>
</td>
			</tr>
			<tr>
				<td class="halfwidth">Gold:</td>
				<td class="halfwidth2"><?php echo $this->_tpl_vars['character']['gold']; ?>
</td>
			</tr>
		</table>
<!--End: Character Details Block-->