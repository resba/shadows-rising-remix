<?php /* Smarty version 2.6.6, created on 2011-05-12 19:36:43
         compiled from setskills_top.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<!--
Title:			Shadows Rising RPG "Deep Blue" Theme (experimental) 
Designed by:	Maugrim The Reaper (http://www.quantum-star.com)
Compliance:		XHTML 1.1
Optimisation:	1024x768 Resolution // Mozilla Firefox 1.0
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

<!--js functions to handle setting skills - note that the Game Engine will validate the data from this form. The javascript alerts are warnings, if they are ignored or actively bypassed the Game Engine will realise this and issue a SystemMessage(). We use parseInt() on arguments to ensure all numbers passed are treated as integers rather than strings-->

<!--We only need to use literal Smarty tags to surround non-Smarty curly braces such as those in Javascript - otherwise the Smarty engine would parse these by accident, cause an error, and return a blank page!-->

<?php echo '

<script type="text/javascript">
<!--

	function incrementAllocatedPoints(skillInputID, skillSpanID, charLevel) {
		var skillPoints;
		var oldPoints;
		var newPoints;
		var newTotalPoints;
		var maxSkillPoints;
		maxSkillPoints = parseInt(charLevel) + 3;
		oldPoints = parseInt(document.getElementById(skillInputID).value);
		skillPoints = parseInt(document.getElementById(\'skill_pts\').value);
		if(skillPoints <= 0) {
			alert("You have utilised all your free skill points!\\n\\nYou may be able to claw back some skill points by reducing those you might have just allocated to other skills.");
		}
		else if(oldPoints >= maxSkillPoints)
		{
			alert("You may not add more points to this skill.\\n\\nThe maximum points you can add to any skill equals your current character level plus 3, i.e. " + maxSkillPoints + " points.");
		}
		else
		{
			newPoints = oldPoints + 1;
			newTotalPoints = skillPoints - 1;
			document.getElementById(\'skill_pts\').value = newTotalPoints;
			document.getElementById(skillInputID).value = newPoints;
			document.getElementById(skillSpanID).innerHTML = "&nbsp;"+newPoints+"&nbsp;";
			document.getElementById(\'skill_pts_text\').innerHTML = "&nbsp;"+newTotalPoints+"&nbsp;";
		}
	}

	function decrementAllocatedPoints(skillInputID, skillSpanID, originalPoints, originalFreePoints) {
		var skillPoints;
		var oldPoints;
		var newPoints;
		var newTotalPoints;
		originalFreePoints = parseInt(originalFreePoints);
		oldPoints = parseInt(document.getElementById(skillInputID).value);
		skillPoints = parseInt(document.getElementById(\'skill_pts\').value);
		if(oldPoints <= originalPoints) {
			alert("You cannot reduce your points for this skill below their previous level.\\n\\nYou may only reduce points where you have first added points to a skill.");
		}
		else
		{
			newPoints = oldPoints - 1;
			newTotalPoints = skillPoints + 1;
			if(newTotalPoints > originalFreePoints) {
				alert("You cannot reduce points for any skill at this time.\\n\\nYou may not reduce skill points below their original level, nor in any way that may increase your free skill points above their original level.");
			}
			else
			{
				document.getElementById(\'skill_pts\').value = newTotalPoints;
				document.getElementById(skillInputID).value = newPoints;
				document.getElementById(skillSpanID).innerHTML = "&nbsp;"+newPoints+"&nbsp;";
				document.getElementById(\'skill_pts_text\').innerHTML = "&nbsp;"+newTotalPoints+"&nbsp;";
			}
		}
	}


// -->
</script>

'; ?>


<!--End of ChangeMerchantPanel javascript function-->

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