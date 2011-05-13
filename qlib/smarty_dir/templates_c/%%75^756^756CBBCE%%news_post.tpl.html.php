<?php /* Smarty version 2.6.6, created on 2011-05-12 19:33:51
         compiled from /home/resbahco/public_html/lab/rpg/qcms/modules/Admin_Submit_News/templates/news_post.tpl.html */ ?>
<div>

<form method="post" action="<?php echo $this->_tpl_vars['M_URL']; ?>
" id="post_news" name="post_news">
<input type="hidden" name="op" value="preview" />
<span class="th">Title:</span><br />
<input type="text" name="n_title" value="" size="67" maxlength="67" />
<br />
<br />
<span class="th">News Text:</span><br />
<textarea name="n_text" cols="50" rows="15" wrap="virtual"></textarea>
<br />
<em>(You may enter html to aid presentation, newlines are converted to html breaks)</em>
<br />
<br />
<input type="submit" value="Submit" name="n_submit" />&nbsp;<input type="reset" value="Reset" name="n_reset" />
</form>

</div>