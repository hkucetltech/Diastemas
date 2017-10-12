<? defined("_ACCESS_") or die('Restricted access'); ?>
<?
if(!isLogin())
{
	echo "<script language='javascript'>top.location='".$SETUPFOLDER."/index.php';</script>";
	return;
}
?>