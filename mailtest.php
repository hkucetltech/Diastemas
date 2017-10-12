<? require "include/csmtp.class.php"?>

<?
if($_POST["action"]=="send")
{
	/***************發送電郵--開始****************/
	$MailTitle = $_POST["MailTitle"];
	$MailTitle = iconv('UTF-8','UTF-8',$MailTitle);
	
	$MailContent = $_POST["MailContent"];
	$MailContent = iconv('UTF-8','UTF-8',$MailContent);
	
	$SmtpServer = $_POST["SmtpServer"];
	$SmtpUserName = $_POST["SmtpUserName"];
	$SmtpUserPwd = $_POST["SmtpUserPwd"];
	$SmtpUserShow = $_POST["SmtpUserName"];
	$SmtpServerPort = $_POST["SmtpServerPort"];
	
	$ReceiveEmail = $_POST["ReceiveEmail"];
	
	$smtp = new smtp($SmtpServer,$SmtpServerPort,false,$SmtpUserName,$SmtpUserPwd);
	$sendr = $smtp->sendmail($ReceiveEmail,$SmtpUserShow, $MailTitle, $MailContent, 'HTML');
	 
	if(!$sendr)
	{   
		echo "<script language='javascript'>alert('fail');window.location.href='mailtest.php';</script>";
		return;  
	}
	else
	{   
		echo "<script language='javascript'>alert('success');window.location.href='mailtest.php';</script>";
		return;  
	}
	/***************發送電郵--結束****************/
}
?>
<form id="SendForm" name="SendForm" method="post" action="">
<input type="hidden" name="action" value="send">
<table width="400" border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td width="110">smtp server</td>
    <td width="272">
      <input name="SmtpServer" type="text" id="SmtpServer" value="mail.hku.hk" />
    </td>
  </tr>
  <tr>
    <td>user name</td>
    <td><input name="SmtpUserName" type="text" id="SmtpUserName" value="ptkyuen@hku.hk" /></td>
  </tr>
  <tr>
    <td>user pwd </td>
    <td><input name="SmtpUserPwd" type="text" id="SmtpUserPwd" /></td>
  </tr>
  <tr>
    <td>server port </td>
    <td><input name="SmtpServerPort" type="text" id="SmtpServerPort" value="25" /></td>
  </tr>
  <tr>
    <td>title</td>
    <td><input name="MailTitle" type="text" id="MailTitle" /></td>
  </tr>
  <tr>
    <td>content</td>
    <td><textarea name="MailContent" rows="5" id="MailContent"></textarea></td>
  </tr>
  <tr>
    <td>send to </td>
    <td><input name="ReceiveEmail" type="text" id="ReceiveEmail" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="send" />
      <input type="reset" name="Submit2" value="reset" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
