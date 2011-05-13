<?php /* Smarty version 2.6.6, created on 2011-05-12 19:45:10
         compiled from equipmenu.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "backpack_top.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<p>
Your character's backpack contains all items they are currently carrying, plus contains an overview of any equipped items not directly carried in the backpack. Eventually you'll be able to equip and unequip items from this page.
</p>
<br />

<p class="h5">Equipped Items<br /></p>

<table cellspacing="0" class="invisible">
	<tr>
		<th>Head<th>
		<?php if ($this->_tpl_vars['equipped_head_check'] == 'true'): ?>
		<td><?php echo $this->_tpl_vars['equipped_head']['item_name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/item_equip.php?op=unequip&amp;position=head">Unequip &quot;<?php echo $this->_tpl_vars['equipped_head']['item_name']; ?>
&quot;</a>
		<?php else: ?>
		<td>--empty--</td>
		<?php endif; ?>
	</tr>
	<tr>
		<th>Waist<th>
		<?php if ($this->_tpl_vars['equipped_belt_check'] == 'true'): ?>
		<td><?php echo $this->_tpl_vars['equipped_belt']['item_name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/item_equip.php?op=unequip&amp;position=belt">Unequip &quot;<?php echo $this->_tpl_vars['equipped_belt']['item_name']; ?>
&quot;</a>
		<?php else: ?>
		<td>--empty--</td>
		<?php endif; ?>
	</tr>
	<tr>
		<th>Left Ring Finger<th>
		<?php if ($this->_tpl_vars['equipped_ringl_check'] == 'true'): ?>
		<td><?php echo $this->_tpl_vars['equipped_ringl']['item_name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/item_equip.php?op=unequip&amp;position=ringl">Unequip &quot;<?php echo $this->_tpl_vars['equipped_ringl']['item_name']; ?>
&quot;</a>
		<?php else: ?>
		<td>--empty--</td>
		<?php endif; ?>
	</tr>
	<tr>
		<th>Right Ring Finger<th>
		<?php if ($this->_tpl_vars['equipped_ringr_check'] == 'true'): ?>
		<td><?php echo $this->_tpl_vars['equipped_ringr']['item_name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/item_equip.php?op=unequip&amp;position=ringr">Unequip &quot;<?php echo $this->_tpl_vars['equipped_ringr']['item_name']; ?>
&quot;</a>
		<?php else: ?>
		<td>--empty--</td>
		<?php endif; ?>
	</tr>
	<tr>
		<th>Cloak<th>
		<?php if ($this->_tpl_vars['equipped_cloak_check'] == 'true'): ?>
		<td><?php echo $this->_tpl_vars['equipped_cloak']['item_name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/item_equip.php?op=unequip&amp;position=cloak">Unequip &quot;<?php echo $this->_tpl_vars['equipped_cloak']['item_name']; ?>
&quot;</a>
		<?php else: ?>
		<td>--empty--</td>
		<?php endif; ?>
	</tr>
	<tr>
		<th>Forearms<th>
		<?php if ($this->_tpl_vars['equipped_bracer_check'] == 'true'): ?>
		<td><?php echo $this->_tpl_vars['equipped_bracer']['item_name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/item_equip.php?op=unequip&amp;position=bracer">Unequip &quot;<?php echo $this->_tpl_vars['equipped_bracer']['item_name']; ?>
&quot;</a>
		<?php else: ?>
		<td>--empty--</td>
		<?php endif; ?>
	</tr>
	<tr>
		<th>Torso<th>
		<?php if ($this->_tpl_vars['equipped_armour_check'] == 'true'): ?>
		<td><?php echo $this->_tpl_vars['equipped_armour']['item_name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/item_equip.php?op=unequip&amp;position=armour">Unequip &quot;<?php echo $this->_tpl_vars['equipped_armour']['item_name']; ?>
&quot;</a>
		<?php else: ?>
		<td>--empty--</td>
		<?php endif; ?>
	</tr>
	<tr>
		<th>Left Hand<th>
		<?php if ($this->_tpl_vars['equipped_weaponl_check'] == 'true'): ?>
		<td><?php echo $this->_tpl_vars['equipped_weaponl']['item_name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/item_equip.php?op=unequip&amp;position=weaponl">Unequip &quot;<?php echo $this->_tpl_vars['equipped_weaponl']['item_name']; ?>
&quot;</a>
		<?php else: ?>
		<td>--empty--</td>
		<?php endif; ?>
	</tr>
	<tr>
		<th>Right Hand<th>
		<?php if ($this->_tpl_vars['equipped_weaponr_check'] == 'true'): ?>
		<td><?php echo $this->_tpl_vars['equipped_weaponr']['item_name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/item_equip.php?op=unequip&amp;position=weaponr">Unequip &quot;<?php echo $this->_tpl_vars['equipped_weaponr']['item_name']; ?>
&quot;</a>
		<?php else: ?>
		<td>--empty--</td>
		<?php endif; ?>
	</tr>
</table>

<div>
<br /><br />
</div>

<p class="h5">Backpack Items<br /></p>


<?php if ($this->_tpl_vars['itemcheck'] == 'true'): ?>
<table cellspacing="0" class="invisible">
	<tr>
		<td class="merchantpanel_left">
		<div>|<a href="javascript:changePackListPanel('weapon')">Weapons</a>|<a href="javascript:changePackListPanel('belt')">Belts</a>|<a href="javascript:changePackListPanel('bracer')">Bracers</a>|<a href="javascript:changePackListPanel('ring')">Rings</a>|<a href="javascript:changePackListPanel('cloak')">Cloaks</a>|</div>
		<div id="lpanel">
<?php endif; ?>

<!--Weapons displayed by default - other categories linked to as above-->
<?php if ($this->_tpl_vars['check_backpackweapon'] == 'true'): ?>

			<p class="h5">Weapons</p>

			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['backpackweapon']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

				<div style="vertical-align: center;"><a href="javascript:changeBackpackPanel('weapon<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['item_id']; ?>
', '<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['equipped']; ?>
', '<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['position']; ?>
', '<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['pack_id']; ?>
')"><img src="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/themes/Deep_Blue/images/items/weapons/weapons_9.png" onMouseOver="javascript:changeStatusColour('weapon<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['pack_id']; ?>
', '<?php echo $this->_tpl_vars['character']['level']; ?>
', '<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['level']; ?>
')" onMouseOut="javascript:defaultStatusColour('weapon<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['pack_id']; ?>
')" style="" id="weapon<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['pack_id']; ?>
" /></a> <?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['item_name_eq']; ?>
</div>

			<?php endfor; endif;  else: ?>
			<p>No weapons carried in backpack... Please check the other categories.</p>
<?php endif; ?>


<?php if ($this->_tpl_vars['itemcheck'] == 'false'): ?>
<p>
Your backpack contains no items!!!
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['itemcheck'] == 'true'): ?>
		</div>
		</td>
		<td class="merchantpanel_right">
			<div id="mpanel">Clicking on any of the items to the left will display that item's description and details in this panel...<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
		</td>
	</tr>
</table>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_bottom.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>