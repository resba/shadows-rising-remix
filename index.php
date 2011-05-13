<?php
if(!isset($goto)) {
  $goto = "qcms/index.php";
}
?>
<html>
<head>
<title>[ Shadows Rising - Browser Based RPG]</title>
</head>
<script language="JavaScript"><!--
if (parent.frames.length > 0) 
{
	parent.location.href = location.href
} 
else 
{
	document.writeln('<FRAMESET ROWS="*" border=0>');
	document.writeln('<FRAME NAME="location_frame" SRC="<?php echo $goto; ?>" SCROLLING="auto" FRAMEBORDER="no" NORESIZE>');
	document.writeln('</frameset>');
}
//-->
</script>
<body bg="#000000">
</body>
</html>
