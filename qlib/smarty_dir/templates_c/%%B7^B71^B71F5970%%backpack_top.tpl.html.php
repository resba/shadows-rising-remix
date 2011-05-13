<?php /* Smarty version 2.6.6, created on 2011-05-12 19:45:10
         compiled from backpack_top.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<!--
Title:			Shadows Rising RPG "Deep Blue" Theme (experimental) 
Designed by:	Maugrim The Reaper (http://www.quantum-star.com)
Compliance:		XHTML 1.1
Optimisation:	1024x768 Resolution // Mozilla Firefox 0.8
-->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?php echo $this->_tpl_vars['game_name']; ?>
 :: <?php echo $this->_tpl_vars['location']['loc_name']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="language" content="en" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/themes/Deep_Blue/style_deepblue.css" type="text/css" />

<!--The ChangeBackpackPanel javascript function was written to create a changeable item info panel for Character Backpack UI-->

<?php echo '

<script type="text/javascript">
<!--

	function changePackListPanel(type) {
		var newList;
		switch (type)
		{

		'; ?>


		case "weapon":
		<?php if ($this->_tpl_vars['check_backpackweapon'] == 'true'): ?>
				newList='<p class="h5">Weapons</p>'
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
					+ '<div style="vertical-align: center;"><a href="javascript:changeBackpackPanel(\'weapon<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['item_id']; ?>
\', \'<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['equipped']; ?>
\', \'<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['position']; ?>
\', \'<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['pack_id']; ?>
\')"><img src="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/themes/Deep_Blue/images/items/weapons/weapons_9.png" alt="weapon<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['item_id']; ?>
" onmouseover="javascript:changeStatusColour(\'weapon<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['pack_id']; ?>
\', \'<?php echo $this->_tpl_vars['character']['level']; ?>
\', \'<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['level']; ?>
\')" onmouseout="javascript:defaultStatusColour(\'weapon<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['pack_id']; ?>
\')" style="" id="weapon<?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['pack_id']; ?>
" /></a> <?php echo $this->_tpl_vars['backpackweapon'][$this->_sections['i']['index']]['item_name_eq']; ?>
</div>'
				<?php endfor; endif; ?>
				+ '<br />';
				break;
		<?php else: ?>
				newList='<p>No Weapons carried in Backpack...</p>';
				break;
		<?php endif; ?>

		case "belt":
		<?php if ($this->_tpl_vars['check_backpackbelt'] == 'true'): ?>
				newList='<p class="h5">Belts</p>'
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['backpackbelt']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					+ '<div style="vertical-align: center;"><a href="javascript:changeBackpackPanel(\'belt<?php echo $this->_tpl_vars['backpackbelt'][$this->_sections['i']['index']]['item_id']; ?>
\', \'<?php echo $this->_tpl_vars['backpackbelt'][$this->_sections['i']['index']]['equipped']; ?>
\', \'<?php echo $this->_tpl_vars['backpackbelt'][$this->_sections['i']['index']]['position']; ?>
\', \'<?php echo $this->_tpl_vars['backpackbelt'][$this->_sections['i']['index']]['pack_id']; ?>
\')"><img src="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/themes/Deep_Blue/images/items/weapons/weapons_9.png" alt="belt<?php echo $this->_tpl_vars['backpackbelt'][$this->_sections['i']['index']]['item_id']; ?>
" onmouseover="javascript:changeStatusColour(\'belt<?php echo $this->_tpl_vars['backpackbelt'][$this->_sections['i']['index']]['pack_id']; ?>
\', \'<?php echo $this->_tpl_vars['character']['level']; ?>
\', \'<?php echo $this->_tpl_vars['backpackbelt'][$this->_sections['i']['index']]['level']; ?>
\')" onmouseout="javascript:defaultStatusColour(\'belt<?php echo $this->_tpl_vars['backpackbelt'][$this->_sections['i']['index']]['pack_id']; ?>
\')" style="" id="belt<?php echo $this->_tpl_vars['backpackbelt'][$this->_sections['i']['index']]['pack_id']; ?>
" /></a> <?php echo $this->_tpl_vars['backpackbelt'][$this->_sections['i']['index']]['item_name_eq']; ?>
</div>'
				<?php endfor; endif; ?>
				+ '<br />';
				break;
		<?php else: ?>
				newList='<p>No Belts carried in Backpack...</p>';
				break;
		<?php endif; ?>

		case "bracer":
		<?php if ($this->_tpl_vars['check_backpackbracer'] == 'true'): ?>
				newList='<p class="h5">Bracers</p>'
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['backpackbracer']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					+ '<div style="vertical-align: center;"><a href="javascript:changeBackpackPanel(\'bracer<?php echo $this->_tpl_vars['backpackbracer'][$this->_sections['i']['index']]['item_id']; ?>
\', \'<?php echo $this->_tpl_vars['backpackbracer'][$this->_sections['i']['index']]['equipped']; ?>
\', \'<?php echo $this->_tpl_vars['backpackbracer'][$this->_sections['i']['index']]['position']; ?>
\', \'<?php echo $this->_tpl_vars['backpackbracer'][$this->_sections['i']['index']]['pack_id']; ?>
\')"><img src="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/themes/Deep_Blue/images/items/weapons/weapons_9.png" alt="bracer<?php echo $this->_tpl_vars['backpackbracer'][$this->_sections['i']['index']]['item_id']; ?>
" onmouseover="javascript:changeStatusColour(\'bracer<?php echo $this->_tpl_vars['backpackbracer'][$this->_sections['i']['index']]['pack_id']; ?>
\', \'<?php echo $this->_tpl_vars['character']['level']; ?>
\', \'<?php echo $this->_tpl_vars['backpackbracer'][$this->_sections['i']['index']]['level']; ?>
\')" onmouseout="javascript:defaultStatusColour(\'bracer<?php echo $this->_tpl_vars['backpackbracer'][$this->_sections['i']['index']]['pack_id']; ?>
\')" style="" id="bracer<?php echo $this->_tpl_vars['backpackbracer'][$this->_sections['i']['index']]['pack_id']; ?>
" /></a> <?php echo $this->_tpl_vars['backpackbracer'][$this->_sections['i']['index']]['item_name_eq']; ?>
</div>'
				<?php endfor; endif; ?>
				+ '<br />';
				break;
		<?php else: ?>
				newList='<p>No Bracers carried in Backpack...</p>';
				break;
		<?php endif; ?>

		case "ring":
		<?php if ($this->_tpl_vars['check_backpackring'] == 'true'): ?>
				newList='<p class="h5">Ring</p>'
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['backpackring']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					+ '<div style="vertical-align: center;"><a href="javascript:changeBackpackPanel(\'ring<?php echo $this->_tpl_vars['backpackring'][$this->_sections['i']['index']]['item_id']; ?>
\', \'<?php echo $this->_tpl_vars['backpackring'][$this->_sections['i']['index']]['equipped']; ?>
\', \'<?php echo $this->_tpl_vars['backpackring'][$this->_sections['i']['index']]['position']; ?>
\', \'<?php echo $this->_tpl_vars['backpackring'][$this->_sections['i']['index']]['pack_id']; ?>
\')"><img src="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/themes/Deep_Blue/images/items/weapons/weapons_9.png" alt="ring<?php echo $this->_tpl_vars['backpackring'][$this->_sections['i']['index']]['item_id']; ?>
" onmouseover="javascript:changeStatusColour(\'ring<?php echo $this->_tpl_vars['backpackring'][$this->_sections['i']['index']]['pack_id']; ?>
\', \'<?php echo $this->_tpl_vars['character']['level']; ?>
\', \'<?php echo $this->_tpl_vars['backpackring'][$this->_sections['i']['index']]['level']; ?>
\')" onmouseout="javascript:defaultStatusColour(\'ring<?php echo $this->_tpl_vars['backpackring'][$this->_sections['i']['index']]['pack_id']; ?>
\')" style="" id="ring<?php echo $this->_tpl_vars['backpackring'][$this->_sections['i']['index']]['pack_id']; ?>
" /></a> <?php echo $this->_tpl_vars['backpackring'][$this->_sections['i']['index']]['item_name_eq']; ?>
</div>'
				<?php endfor; endif; ?>
				+ '<br />';
				break;
		<?php else: ?>
				newList='<p>No Rings carried in Backpack...</p>';
				break;
		<?php endif; ?>

		case "cloak":
		<?php if ($this->_tpl_vars['check_backpackcloak'] == 'true'): ?>
				newList='<p class="h5">Cloaks</p>'
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['backpackcloak']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					+ '<div style="vertical-align: center;"><a href="javascript:changeBackpackPanel(\'cloak<?php echo $this->_tpl_vars['backpackcloak'][$this->_sections['i']['index']]['item_id']; ?>
\', \'<?php echo $this->_tpl_vars['backpackcloak'][$this->_sections['i']['index']]['equipped']; ?>
\', \'<?php echo $this->_tpl_vars['backpackcloak'][$this->_sections['i']['index']]['position']; ?>
\', \'<?php echo $this->_tpl_vars['backpackcloak'][$this->_sections['i']['index']]['pack_id']; ?>
\')"><img src="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/themes/Deep_Blue/images/items/weapons/weapons_9.png" alt="cloak<?php echo $this->_tpl_vars['backpackcloak'][$this->_sections['i']['index']]['item_id']; ?>
" onmouseover="javascript:changeStatusColour(\'cloak<?php echo $this->_tpl_vars['backpackcloak'][$this->_sections['i']['index']]['pack_id']; ?>
\', \'<?php echo $this->_tpl_vars['character']['level']; ?>
\', \'<?php echo $this->_tpl_vars['backpackcloak'][$this->_sections['i']['index']]['level']; ?>
\')" onmouseout="javascript:defaultStatusColour(\'cloak<?php echo $this->_tpl_vars['backpackcloak'][$this->_sections['i']['index']]['pack_id']; ?>
\')" style="" id="cloak<?php echo $this->_tpl_vars['backpackcloak'][$this->_sections['i']['index']]['pack_id']; ?>
" /></a> <?php echo $this->_tpl_vars['backpackcloak'][$this->_sections['i']['index']]['item_name_eq']; ?>
</div>'
				<?php endfor; endif; ?>
				+ '<br />';
				break;
		<?php else: ?>
				newList='<p>No Cloaks carried in Backpack...</p>';
				break;
		<?php endif; ?>

		<?php echo '
		}
		document.getElementById(\'lpanel\').innerHTML=newList;
	}

	function changeBackpackPanel(itemType, equipStatus, itemPosition, packID) {
		var newDesc;
		switch (itemType)
		{

		'; ?>


		<?php if ($this->_tpl_vars['check_weapon'] == 'true'): ?>
			<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['weapon']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
			case "weapon<?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['item_id']; ?>
":
				newDesc='<p><span class="h5"><?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['name']; ?>
</span></p><p><?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['description']; ?>
</p><p>Cost: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['cost']; ?>
</span> Credits</p><p><span class="h5">Details:</span></p><p>Weight: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['weight']; ?>
</span></p><p>Alignment: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['alignment']; ?>
</span></p><p>Damage: <span style="font-weight: bold;">1d<?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['max_damage']; ?>
</span></p><p>Critical: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['min_critical']; ?>
-<?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['max_critical']; ?>
/x<?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['critical_multiplier']; ?>
</span></p><br /><p>Handling: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['weapon'][$this->_sections['j']['index']]['handle']; ?>
</span></p>';
				<?php echo '
				if (equipStatus == 1 || equipStatus == 2)
				{
					newDesc = newDesc + \'<a href="item_equip.php?op=unequip&amp;position=\' + itemPosition + \'">Unequip</a>\';
				}
				else
				{
					newDesc = newDesc + \'<a href="item_equip.php?op=equip&amp;type=weapon&amp;pack_id=\' + packID + \'">Equip</a> <a href="merchant.php?sell=1&amp;sell_weapon=\' + packID + \'">Sell Item</a>\';
				}
				'; ?>

				break;
			<?php endfor; endif; ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['check_ring'] == 'true'): ?>
			<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['ring']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
			case "ring<?php echo $this->_tpl_vars['ring'][$this->_sections['j']['index']]['item_id']; ?>
":
				newDesc='<p><span class="h5"><?php echo $this->_tpl_vars['ring'][$this->_sections['j']['index']]['name']; ?>
</span></p><p><?php echo $this->_tpl_vars['ring'][$this->_sections['j']['index']]['description']; ?>
</p><p>Cost: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['ring'][$this->_sections['j']['index']]['cost']; ?>
</span> Credits</p><p><span class="h5">Details:</span></p><p>Weight: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['ring'][$this->_sections['j']['index']]['weight']; ?>
</span></p><p>Alignment: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['ring'][$this->_sections['j']['index']]['alignment']; ?>
</span></p><p>Effects: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['ring'][$this->_sections['j']['index']]['effect']; ?>
</span></p><p>Effect Bonus: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['ring'][$this->_sections['j']['index']]['effect_type']; ?>
 +<?php echo $this->_tpl_vars['ring'][$this->_sections['j']['index']]['effect_amount']; ?>
</span></p>';
				<?php echo '
				if (equipStatus == 1)
				{
					newDesc = newDesc + \'<a href="item_equip.php?op=unequip&amp;position=\' + itemPosition + \'">Unequip</a>\';
				}
				else
				{
					newDesc = newDesc + \'<a href="item_equip.php?op=equip&amp;type=ring&amp;pack_id=\' + packID + \'">Equip</a> <a href="merchant.php?sell=1&amp;sell_ring=\' + packID + \'">Sell Item</a>\';
				}
				'; ?>

				break;
			<?php endfor; endif; ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['check_belt'] == 'true'): ?>
			<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['belt']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
			case "belt<?php echo $this->_tpl_vars['belt'][$this->_sections['j']['index']]['item_id']; ?>
":
				newDesc='<p><span class="h5"><?php echo $this->_tpl_vars['belt'][$this->_sections['j']['index']]['name']; ?>
</span></p><p><?php echo $this->_tpl_vars['belt'][$this->_sections['j']['index']]['description']; ?>
</p><p>Cost: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['belt'][$this->_sections['j']['index']]['cost']; ?>
</span> Credits</p><p><span class="h5">Details:</span></p><p>Weight: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['belt'][$this->_sections['j']['index']]['weight']; ?>
</span></p><p>Alignment: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['belt'][$this->_sections['j']['index']]['alignment']; ?>
</span></p><p>Effects: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['belt'][$this->_sections['j']['index']]['effect']; ?>
</span></p><p>Effect Bonus: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['belt'][$this->_sections['j']['index']]['effect_type']; ?>
 +<?php echo $this->_tpl_vars['belt'][$this->_sections['j']['index']]['effect_amount']; ?>
</span></p>';
				<?php echo '
				if (equipStatus == 1)
				{
					newDesc = newDesc + \'<a href="item_equip.php?op=unequip&amp;position=\' + itemPosition + \'">Unequip</a>\';
				}
				else
				{
					newDesc = newDesc + \'<a href="item_equip.php?op=equip&amp;type=belt&amp;pack_id=\' + packID + \'">Equip</a> <a href="merchant.php?sell=1&amp;sell_belt=\' + packID + \'">Sell Item</a>\';
				}
				'; ?>

				break;
			<?php endfor; endif; ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['check_bracer'] == 'true'): ?>
			<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['bracer']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
			case "bracer<?php echo $this->_tpl_vars['bracer'][$this->_sections['j']['index']]['item_id']; ?>
":
				newDesc='<p><span class="h5"><?php echo $this->_tpl_vars['bracer'][$this->_sections['j']['index']]['name']; ?>
</span></p><p><?php echo $this->_tpl_vars['bracer'][$this->_sections['j']['index']]['description']; ?>
</p><p>Cost: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['bracer'][$this->_sections['j']['index']]['cost']; ?>
</span> Credits</p><p><span class="h5">Details:</span></p><p>Weight: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['bracer'][$this->_sections['j']['index']]['weight']; ?>
</span></p><p>Alignment: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['bracer'][$this->_sections['j']['index']]['alignment']; ?>
</span></p><p>Effects: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['bracer'][$this->_sections['j']['index']]['effect']; ?>
</span></p><p>Effect Bonus: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['bracer'][$this->_sections['j']['index']]['effect_type']; ?>
 +<?php echo $this->_tpl_vars['bracer'][$this->_sections['j']['index']]['effect_amount']; ?>
</span></p>';
				<?php echo '
				if (equipStatus == 1)
				{
					newDesc = newDesc + \'<a href="item_equip.php?op=unequip&amp;position=\' + itemPosition + \'">Unequip</a>\';
				}
				else
				{
					newDesc = newDesc + \'<a href="item_equip.php?op=equip&amp;type=bracer&amp;pack_id=\' + packID + \'">Equip</a> <a href="merchant.php?sell=1&amp;sell_bracer=\' + packID + \'">Sell Item</a>\';
				}
				'; ?>

				break;
			<?php endfor; endif; ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['check_cloak'] == 'true'): ?>
			<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['cloak']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
			case "cloak<?php echo $this->_tpl_vars['cloak'][$this->_sections['j']['index']]['item_id']; ?>
":
				newDesc='<p><span class="h5"><?php echo $this->_tpl_vars['cloak'][$this->_sections['j']['index']]['name']; ?>
</span></p><p><?php echo $this->_tpl_vars['cloak'][$this->_sections['j']['index']]['description']; ?>
</p><p>Cost: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['cloak'][$this->_sections['j']['index']]['cost']; ?>
</span> Credits</p><p><span class="h5">Details:</span></p><p>Weight: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['cloak'][$this->_sections['j']['index']]['weight']; ?>
</span></p><p>Alignment: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['cloak'][$this->_sections['j']['index']]['alignment']; ?>
</span></p><p>Effects: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['cloak'][$this->_sections['j']['index']]['effect']; ?>
</span></p><p>Effect Bonus: <span style="font-weight: bold;"><?php echo $this->_tpl_vars['cloak'][$this->_sections['j']['index']]['effect_type']; ?>
 +<?php echo $this->_tpl_vars['cloak'][$this->_sections['j']['index']]['effect_amount']; ?>
</span></p>';
				<?php echo '
				if (equipStatus == 1)
				{
					newDesc = newDesc + \'<a href="item_equip.php?op=unequip&amp;position=\' + itemPosition + \'">Unequip</a>\';
				}
				else
				{
					newDesc = newDesc + \'<a href="item_equip.php?op=equip&amp;type=cloak&amp;pack_id=\' + packID + \'">Equip</a> <a href="merchant.php?sell=1&amp;sell_cloak=\' + packID + \'">Sell Item</a>\';
				}
				'; ?>

				break;
			<?php endfor; endif; ?>
		<?php endif; ?>

		<?php echo '
		}
		document.getElementById(\'mpanel\').innerHTML=newDesc;
	}

	function changeStatusColour(packType, charLevel, itemLevel) {
		var newColour;
		if (charLevel >= itemLevel) 
		{
			newColour=\'darkgreen\';
		}
		else
		{
			newColour=\'darkred\';
		}
		document.getElementById(packType).style.backgroundColor = newColour;
	}

	function defaultStatusColour(packType) {
		defaultColour = \'transparent\';
		document.getElementById(packType).style.backgroundColor = defaultColour;
	}


// -->
</script>

'; ?>


<!--End of ChangeBackpackPanel javascript function-->

</head>
<body class="default">

<table cellspacing="0" class="default" width="100%" style="text-align: center; border: 0px;">
	<tr>
		<td width="100%" colspan="5" class="internal" style="text-align: center; background-color: #000000;">
			<img src="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/themes/Deep_Blue/images/logo.gif" alt="Shadows Rising" title="Shadows Rising" />
		</td>
	</tr>
	<tr>
		<td width="100%" colspan="5" style="height: 5px">
		</td>
	</tr>
</table>


<table cellspacing="0" class="default" width="100%" style="text-align: center; border: 0px;">
	<tr>
		<td id="page_leftpanel">
<!--This is the left side panel, this holding table cell will contain tables for user information-->

	<table cellspacing="0" class="block">
	<tr>
		<td>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "blocks/nav_menu.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
	</table><br />

	<table cellspacing="0" class="block">
	<tr>
		<td>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "blocks/character_details.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
	</table><br />

	<table cellspacing="0" class="block">
	<tr>
		<td>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "blocks/character_attributes.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
	</table><br />

<!--This is the end of the left side panel-->
		</td>
		<td width="5">
		&nbsp;
		</td>
		<td id="page_centerpanel">
			<table cellspacing="0" class="module">
				<tr>
					<td>
<!--This is the center panel where user actions, text, and menus will appear-->