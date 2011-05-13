<?php /* Smarty version 2.6.6, created on 2011-05-12 19:33:39
         compiled from /home/resbahco/public_html/lab/rpg/qcms/blocks/sitelinks.tpl.html */ ?>
<table cellspacing="0" class="invisible">
	<tr>
		<td>
			<a href="index.php" class="page_menu">::&nbsp;&nbsp;&nbsp;Home</a><br />
		</td>
	</tr>

<?php if (isset($this->_foreach['outer'])) unset($this->_foreach['outer']);
$this->_foreach['outer']['total'] = count($_from = (array)$this->_tpl_vars['categories']);
$this->_foreach['outer']['show'] = $this->_foreach['outer']['total'] > 0;
if ($this->_foreach['outer']['show']):
$this->_foreach['outer']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['cat_title'] => $this->_tpl_vars['cat']):
        $this->_foreach['outer']['iteration']++;
        $this->_foreach['outer']['first'] = ($this->_foreach['outer']['iteration'] == 1);
        $this->_foreach['outer']['last']  = ($this->_foreach['outer']['iteration'] == $this->_foreach['outer']['total']);
?>
	<tr>
		<th>
		<?php echo $this->_tpl_vars['cat_title']; ?>

		</th>
	</tr>
	<tr>
		<td>
		<?php if (isset($this->_foreach['inner'])) unset($this->_foreach['inner']);
$this->_foreach['inner']['total'] = count($_from = (array)$this->_tpl_vars['cat']);
$this->_foreach['inner']['show'] = $this->_foreach['inner']['total'] > 0;
if ($this->_foreach['inner']['show']):
$this->_foreach['inner']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['prelink']):
        $this->_foreach['inner']['iteration']++;
        $this->_foreach['inner']['first'] = ($this->_foreach['inner']['iteration'] == 1);
        $this->_foreach['inner']['last']  = ($this->_foreach['inner']['iteration'] == $this->_foreach['inner']['total']);
?>

			<?php if (isset($this->_foreach['inner2'])) unset($this->_foreach['inner2']);
$this->_foreach['inner2']['total'] = count($_from = (array)$this->_tpl_vars['prelink']);
$this->_foreach['inner2']['show'] = $this->_foreach['inner2']['total'] > 0;
if ($this->_foreach['inner2']['show']):
$this->_foreach['inner2']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['link']):
        $this->_foreach['inner2']['iteration']++;
        $this->_foreach['inner2']['first'] = ($this->_foreach['inner2']['iteration'] == 1);
        $this->_foreach['inner2']['last']  = ($this->_foreach['inner2']['iteration'] == $this->_foreach['inner2']['total']);
?>

				<a href="<?php echo $this->_tpl_vars['link']['href']; ?>
" class="page_menu">::&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['link']['name']; ?>
</a><br />

			<?php endforeach; unset($_from); endif; ?>

		<?php endforeach; unset($_from); endif; ?>

		</td>
	</tr>
<?php endforeach; unset($_from); endif; ?>
</table>