<?php /* Smarty version 2.6.6, created on 2011-05-12 21:09:33
         compiled from forum/post.tpl.html */ ?>
<?php if ($this->_tpl_vars['mode'] == 'nopostmode'): ?>
 No post mode specified
<?php elseif ($this->_tpl_vars['mode'] == 'invalidpostmode'): ?>
 Invalid post mode 
<?php elseif ($this->_tpl_vars['mode'] == 'newpost'): ?>
 <table width="100%">
 <form action="post.php?postmode=<?php echo $_REQUEST['postmode']; ?>
&<?php if ($_REQUEST['f'] != ""): ?>f=<?php echo $_REQUEST['f'];  elseif ($_REQUEST['t'] != ""): ?>t=g<?php echo $_REQUEST['t'];  endif; ?>" method="POST">
  <tr><td width="30%"></td><td>Subject: <input type="text" name="subject" id="subject" size="30"></td></tr>
  <tr><td> 
  <center><ul>Emotionicons</ul></center>
  </td><td>
   Message:
   <br><textarea cols="40" rows="10" name="msg" id="msg"></textarea>
  </td></tr>
  <tr><td></td>
  <td><input type="submit" value="Submit"></td>
  </tr>
 </table>
</form>
<?php endif; ?>