<?php /* Smarty version 2.6.6, created on 2011-05-12 19:36:30
         compiled from location.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "location_top.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<!--Sample text for the center panel-->
		<div style="text-align: center; border: dashed 1px gold;">
		<br />
		KANGAROO INFESTATION! The local peasants have been terrorised by hordes of Giant Kangaroos. You can earn small amounts of Gold and Experience by lending a hand and "persuading" some of these Creatures to leave...permanantly...
		<br /><br />
		<a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/combat.php?cid=1">Attack a Giant Kangaroo!</a>
		<br /><br />
		</div>

		<div>
		<br /><br />
		</div>

		<div style="text-align: center;">				
		A control panel is now available for the Administrator. There you will find MapGen, and also a utility to add any edited/created map to the game. Note that travel within the game is impossible until a map has been added from the control panel.
		</div>

		<div><br /><br /><br /></div>

		<div style="text-align: center; border: dashed 1px gold; width: 100px;">
		Open Locked Chest (skill test)
		<br /><br />
		<?php echo $this->_tpl_vars['test_result']; ?>

		</div>

<!--This is the end of the center panel-->
					</td>
				</tr>
			</table>
		</td>
		<td width="5">
		&nbsp;
		</td>
		<td id="page_rightpanel">
<!--This is the right side panel for holding maps and location overview-->

		<!--A location map graphic for the page - generated by build_world.php, stored in /core/maps/-->
		<div align="center">
		<table cellspacing="0" cellpadding="0" bgcolor="#000000">
			<tr>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['1']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['1']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['2']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['2']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['3']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['3']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['4']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['4']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['5']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['5']; ?>
" /></td>
				<td rowspan="6"><img src="images/other/compass.jpg" alt="Keyboard= North: w, East: d, South: s, West: a" title="Keyboard= North: w, East: d, South: s, West: a" /></td>
			</tr>
			<tr>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['6']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['6']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['7']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['7']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['8']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['8']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['9']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['9']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['10']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['10']; ?>
" /></td>
			</tr>
			<tr>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['11']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['11']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['12']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['12']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['13']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['13']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['14']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['14']; ?>
" /></td>
				<td><img src="images/terrain/<?php echo $this->_tpl_vars['map_img']['15']; ?>
" alt="<?php echo $this->_tpl_vars['map_img']['15']; ?>
" /></td>
			</tr>
		</table>
		</div>

		<br />

		<!--Sample location details table-->
		<table cellspacing="0" class="block" style="width: 200px;">
			<tr>
				<th colspan="2"><?php echo $this->_tpl_vars['location_name']; ?>
</th>
			</tr>
			<tr>
				<td class="halfwidth">Size:</td>
				<td class="halfwidth2">Citadel</td>
			</tr>
			<tr>
				<td class="halfwidth">Pop:</td>
				<td class="halfwidth2">55,674 Souls</td>
			</tr>
			<tr>
				<td class="halfwidth">Race:</td>
				<td class="halfwidth2">Human/Elf</td>
			</tr>
			<tr>
				<td class="halfwidth">Info:</td>
				<td class="halfwidth2">Capital City of Human Territory</td>
			</tr>
			<tr>
				<td class="halfwidth">Contacts:</td>
				<td class="halfwidth2">None</td>
			</tr>
		</table>

<!--This is the end of the right side panel-->
		</td>
	</tr>
	<tr>
		<td width="100%" colspan="5" style="height: 5px">
		</td>
	</tr>
</table>
<!--This is the footer cell visible at the bottom of all pages-->

<div align="center">
	<br /><br /><br />
	<br /><br /><br />
	<br /><br /><br />
	<br /><br /><br />
	<br /><br /><br />
	<br /><br /><br />
	<br /><br /><br />
	Page generated in: <?php echo $this->_tpl_vars['exec_time']; ?>
 seconds.
	<br /><br /><br />
	<a href="http://www.shadowsrising.net" target="_blank"><?php echo $this->_tpl_vars['code_base']; ?>
</a> &copy; Copyright 2004 Shadows Rising Project Developers<br />
	Deep Blue Theme &copy; 2004 Maugrim The Reaper and <a onclick="window.open(this.href,'_blank');return false;" href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/docs/copyright.html">Shadows Rising Project Developers</a>
	<br /><br /><br />
<table class="default" style="border: 0px">
	<tr>
		<td>
			<img src="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/images/standards/valid-xhtml11.png" alt="Valid XHTML 1.0!" height="31" width="88" style="border: 0px" />
			<img src="<?php echo $this->_tpl_vars['url_prefix']; ?>
/core/images/standards/vcss.png" alt="Valid CSS 1/2!" height="31" width="88" style="border: 0px" />
		</td>
	</tr>
</table>
</div>
	

<!--This is the end of the footer cell-->
</td>
</tr> 
</table>
<!--This is the end of the "holding" table created per Step Three-->

</body>
</html>