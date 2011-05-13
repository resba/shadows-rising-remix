<?php /* Smarty version 2.6.6, created on 2011-05-12 19:33:39
         compiled from /home/resbahco/public_html/lab/rpg/qcms/blocks/login.tpl.html */ ?>
			<table cellspacing="0" class="invisible">
				<tr>
					<td>

<?php if ($this->_tpl_vars['sessionvalid'] == 'true'): ?>

	<table width="100%" class="invisible">
		<tr>
			<td>
				Welcome, <?php echo $this->_tpl_vars['username']; ?>
! You are logged in.
				<br /><br />
				<?php echo $this->_tpl_vars['users_online']; ?>
 Members Online
				<br /><br />
				<a href="logout.php" class="page_menu" style="text-align: center;">Logout</a>
			</td>
		</tr>
	</table>

<?php else: ?>

	<form method="post" action="module.php?dir=Login_Process" id="login_form" name="login_form"  onSubmit="doChallengeResponse()">
	<table width="100%" class="invisible">
		<tr>
			<td>
				Username:
			</td>
			<td>
				<input type="text" name="l_name" value="" size="10" />
			</td>
		</tr>
		<tr>
			<td>
				Password:
			</td>
			<td>
				<input type="password" name="passwd" value="" size="10" />
			</td>
		</tr>
		<tr>
			<td>
				<br />
				<input type="reset" name="u_reset" value="Reset" />
			</td>
			<td>
				<br />
				<input type="submit" name="u_submit" value="Login" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<br /><br />
				<?php echo $this->_tpl_vars['users_online']; ?>
 Members Online
				<br /><br />
			</td>
		</tr>
	</table>

	<table width="100%" class="invisible">
		<tr>
			<td>
				<a href="module.php?dir=User_Signup" class="page_menu" style="text-align: center;">Create Account</a>
			</td>
		</tr>
	</table>
		<!-- Set up the form with the challenge value and an empty reply value -->
		<input type="hidden" name="challenge" value="<?php echo $this->_tpl_vars['challenge']; ?>
" />
		<input type="hidden" name="response" value="" />
		</form>

		<form method="post" name="logintrue" action="module.php?dir=Login_Process">
		<input type="hidden" name="l_name" value="" />
		<input type="hidden" name="challenge" value="$challenge" />
		<input type="hidden" name="response"  value="" />
		</form>

<?php endif; ?>

					</td>
				</tr>
			</table>