<?
$sqlweb = "Select count(CommunityID) as CommunityNum From htx_community";
$rowweb = $db->getRow($sqlweb);
if($rowweb["CommunityNum"]>0)
	$WebHasCommunity = 1;
else
	$WebHasCommunity = 0;
?>