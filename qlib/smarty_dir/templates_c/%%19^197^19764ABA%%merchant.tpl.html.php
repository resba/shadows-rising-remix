<?php /* Smarty version 2.6.6, created on 2011-05-12 20:19:06
         compiled from merchant.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "merchant_top.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<p>
Welcome to the Merchant menu - being a bit scarce on supplies, this Merchant currently only sells a few items. These items are all essential tools for wannabe Adventurers!
</p>
<br />


<?php if ($this->_tpl_vars['itemcheck'] == 'true'): ?>
<table cellspacing="0" class="invisible">
	<tr>
		<td class="merchantpanel_left">
		<div>|
		<?php if ($this->_tpl_vars['check_weapon'] == 'true'): ?><a href="javascript:changeItemListPanel('weapon')">Weapons</a>|<?php endif; ?>
		<?php if ($this->_tpl_vars['check_belt'] == 'true'): ?><a href="javascript:changeItemListPanel('belt')">Belts</a>|<?php endif; ?>
		<?php if ($this->_tpl_vars['check_bracer'] == 'true'): ?><a href="javascript:changeItemListPanel('bracer')">Bracers</a>|<?php endif; ?>
		<?php if ($this->_tpl_vars['check_ring'] == 'true'): ?><a href="javascript:changeItemListPanel('ring')">Rings</a>|<?php endif; ?>
		<?php if ($this->_tpl_vars['check_cloak'] == 'true'): ?><a href="javascript:changeItemListPanel('cloak')">Cloaks</a>|<?php endif; ?>
		<?php if ($this->_tpl_vars['check_drug'] == 'true'): ?><a href="javascript:changeItemListPanel('drug')">Potions</a>|<?php endif; ?>
		</div>
		<div id="lpanel">
<?php endif; ?>

<!--Weapons displayed by default - other categories linked to as above-->
<?php if ($this->_tpl_vars['check_weapon'] == 'true'): ?>

			<p class="h5">Weapons</p>

			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['weapon']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

				<div style="vertical-align: center;"><a href="javascript:changeMerchantPanel('weapon<?php echo $this->_tpl_vars['weapon'][$this->_sections['i']['index']]['item_id']; ?>
')"><img src="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/themes/Deep_Blue/images/items/weapons/weapons_9.png" onMouseOver="javascript:changeStatusColour('weapon<?php echo $this->_tpl_vars['weapon'][$this->_sections['i']['index']]['item_id']; ?>
', '<?php echo $this->_tpl_vars['character']['level']; ?>
', '<?php echo $this->_tpl_vars['weapon'][$this->_sections['i']['index']]['level']; ?>
')" onMouseOut="javascript:defaultStatusColour('weapon<?php echo $this->_tpl_vars['weapon'][$this->_sections['i']['index']]['item_id']; ?>
')" style="" id="weapon<?php echo $this->_tpl_vars['weapon'][$this->_sections['i']['index']]['item_id']; ?>
" /></a> <?php echo $this->_tpl_vars['weapon'][$this->_sections['i']['index']]['name']; ?>
</div>

			<?php endfor; endif;  else: ?>
			<p>Please select a category above to view available items.</p>
<?php endif; ?>


<?php if ($this->_tpl_vars['itemcheck'] == 'false'): ?>
<p>
Sorry, but this Merchant has no items available which they can sell to you!
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