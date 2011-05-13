<?php /* Smarty version 2.6.6, created on 2011-05-12 19:35:15
         compiled from /home/resbahco/public_html/lab/rpg/qcms/modules/Admin_Submit_News/templates/news_preview.tpl.html */ ?>
<div style="padding-left: 30px; padding-right: 30px;">
<span class="th">Preview:</span>
<br />
<table cellspacing="0" class="inner_mtable">
	<tr>
		<th>
		<?php echo $this->_tpl_vars['n_title']; ?>
<br />
		</th>
	</tr>
	<tr>
		<td>
		<?php echo $this->_tpl_vars['news_text']; ?>

		</td>
	</tr>
</table>
</div>

<div>

<br /><br />

<form method="post" action="<?php echo $this->_tpl_vars['M_URL']; ?>
" name="conf_news">
<input type="hidden" name="op" value="save" />
<input type="hidden" name="n_title" value="<?php echo $this->_tpl_vars['n_title']; ?>
" />
<input type="hidden" name="n_text" value="<?php echo $this->_tpl_vars['n_text']; ?>
" />
Are you sure you wish to save this News Item?
<br />
<br />
<input type="submit" value="Save" name="submit" />
</form>
<br />
<br />
Otherwise, return <a href="index.php">Home</a>.
</div>