<?php /* Smarty version 2.6.6, created on 2011-05-12 19:36:30
         compiled from blocks/nav_menu.tpl.html */ ?>
<!--Start: Navigation Menu Block-->

<?php if (isset($this->_foreach['i'])) unset($this->_foreach['i']);
$this->_foreach['i']['total'] = count($_from = (array)$this->_tpl_vars['navlinks']['left']);
$this->_foreach['i']['show'] = $this->_foreach['i']['total'] > 0;
if ($this->_foreach['i']['show']):
$this->_foreach['i']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['navsection']):
        $this->_foreach['i']['iteration']++;
        $this->_foreach['i']['first'] = ($this->_foreach['i']['iteration'] == 1);
        $this->_foreach['i']['last']  = ($this->_foreach['i']['iteration'] == $this->_foreach['i']['total']);
?>
<b class="th">~~ <?php echo $this->_tpl_vars['navsection']['name']; ?>
 ~~</b><br />
<?php if (isset($this->_foreach['j'])) unset($this->_foreach['j']);
$this->_foreach['j']['total'] = count($_from = (array)$this->_tpl_vars['navsection']['details']);
$this->_foreach['j']['show'] = $this->_foreach['j']['total'] > 0;
if ($this->_foreach['j']['show']):
$this->_foreach['j']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['details']):
        $this->_foreach['j']['iteration']++;
        $this->_foreach['j']['first'] = ($this->_foreach['j']['iteration'] == 1);
        $this->_foreach['j']['last']  = ($this->_foreach['j']['iteration'] == $this->_foreach['j']['total']);
?>
<a href="<?php echo $this->_tpl_vars['details']['url']; ?>
" class="buttonstyle"><?php echo $this->_tpl_vars['details']['title']; ?>
</a><br>
<?php endforeach; unset($_from); endif; ?>
<br />
<?php endforeach; unset($_from); endif; ?>

<!--End: Navigation Menu Block-->