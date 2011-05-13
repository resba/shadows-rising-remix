<?php /* Smarty version 2.6.6, created on 2011-05-12 19:37:04
         compiled from forum/viewforum.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'forum/viewforum.tpl.html', 31, false),)), $this); ?>
<table width="100%">
 <tr>
 <td>
  <center>
   <h2>Forum</h2>
  </center>
 </td>
 </tr>
 <tr>
  <td>
   <?php echo $this->_tpl_vars['forum_name']; ?>

  </td>
 </tr>
 <tr>
  <td>
   <a href="post.php?postmode=topic&f=<?php echo $this->_tpl_vars['forum_id']; ?>
">New Topic</a>
  </td>
 </tr>
 <tr>
 <td>

 <table width="100%" class="viewtopics">
 <tr class="viewtopicstitle"><td></td><td>Topic Title</td><td width="10%">Starter</td><td width="5%"><center>Posts</center></td><td><center>Last Post</center></td></tr>
 
 <?php if (count($_from = (array)$this->_tpl_vars['topics'])):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
 <tr>
 <td class="viewtopicstd"></td>
 <td class="viewtopicstd"><a href="viewtopic.php?t=<?php echo $this->_tpl_vars['v']['topic_id']; ?>
"><?php echo $this->_tpl_vars['v']['topic_name']; ?>
</a></td>
 <td class="viewtopicstd"><a href="profile.php?op=viewuser&id=<?php echo $this->_tpl_vars['v']['starter_id']; ?>
"><?php echo $this->_tpl_vars['v']['starter']; ?>
</a></td>
 <td class="viewtopicstd"><center><?php echo $this->_tpl_vars['v']['totalposts']; ?>
</center></td>
 <td width="20%" class="viewtopicstd"><center><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['lastposttime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
<br /><a href="profile.php?op=viewuser&id=<?php echo $this->_tpl_vars['v']['lastposteruserid']; ?>
"><?php echo $this->_tpl_vars['v']['lastpostuser']; ?>
</a></center></td>
 </tr>
 <?php endforeach; unset($_from); endif; ?>
 
 </table>
 </td>
 </tr>
 <tr>
 <td>
 <a href="post.php?postmode=topic&f=<?php echo $this->_tpl_vars['forum_id']; ?>
">New Topic</a>
 </td>
 </tr>
</table>