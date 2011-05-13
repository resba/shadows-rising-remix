<?php /* Smarty version 2.6.6, created on 2011-05-12 19:36:17
         compiled from /home/resbahco/public_html/lab/rpg/qcms/modules/Game_Index/templates/game_joinconfirm.tpl.html */ ?>
	<div align="center">
	Are you sure you wish to join this game? 
	<br /><br /><b><?php echo $this->_tpl_vars['game']['name']; ?>
</b>
	<br /><br />
	<form method="post" action="<?php echo $this->_tpl_vars['url_prefix']; ?>
/qcms/module.php?dir=Game_Index">
	<input type="hidden" name="op" value="do_join" />
	<input type="hidden" name="sure" value="yes" />
	<input type="hidden" name="confirm_join" value="1" />
	<input type="submit" name="submit" value="Join!" />
	</form>
	<br /><br />
	<a href="<?php echo $this->_tpl_vars['url_prefix']; ?>
/qcms/index.php">Return to HomePage</a>
	</div>