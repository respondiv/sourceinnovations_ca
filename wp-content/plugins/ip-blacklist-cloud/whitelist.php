<?php

if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );



?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>  

<h2>Whitelist</h2>
<?php

global $wpdb,$IP_globale,$IP_error,$found;


	if(isset($_POST['update_whitelist']))
	{

		$white=trim($_POST['whitelist']);
    $white=str_replace(" ","",$white);


		update_option('IPBLC_whitelist',$white);
		echo "<div id='setting-error-settings_updated' class='updated settings-error'> 
<p><strong>Whitelist Updated!</strong></p></div>";

	}

	$IPBLC_whitelist=get_option('IPBLC_whitelist');
	$IPBLC_whitelist=str_replace('\r\n',"\r\n",$IPBLC_whitelist);
  
  $added_my_ip=0;
  
  if(isset($_GET['addMyIp']) && is_admin())
  {
    $addMyIp=$_GET['addMyIp'];
    if(filter_var($addMyIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
    {
      $is_myip_safe=1;
      $is_myip_safe=isIpSafe($addMyIp);
      if($is_myip_safe==0)
      {
        $IPBLC_whitelist.="\r\n".$addMyIp."\r\n";
        $IPBLC_whitelist=trim($IPBLC_whitelist);
        update_option('IPBLC_whitelist',$IPBLC_whitelist);
      	$IPBLC_whitelist=get_option('IPBLC_whitelist');
      	$IPBLC_whitelist=str_replace('\r\n',"\r\n",$IPBLC_whitelist);
        $added_my_ip=1;
      }
    }
  }
  
  if($added_my_ip==1)
  {
		echo "<div id='setting-error-settings_updated' class='updated settings-error'> 
<p><strong>Whitelist Updated!</strong></p></div>";
  }

?>

<BR>

<table>
<tr valign="top" valign="top">
<td style="width: 330px;" valign="top" valign="top">
<form method="post" ENCTYPE="multipart/form-data">
<textarea id="whitelist" name="whitelist" style="width: 300px; height: 250px;" class="regular-text"><?php echo $IPBLC_whitelist; ?></textarea><BR>

<BR>
<input type="submit" name="update_whitelist" id="update_whitelist" value="Save Changes" class="button-primary">
</form>
</td>

<td valign="top" valign="top">Add IP addresses to whitelist and save yourself from auto blacklisting for failed login attempts. Each IP should be on single line.<BR><BR><b>Updates: You can now add ranges to whitelist.</b><BR><BR>Example: <BR>1.1.1.1<BR>1.1.1.0-1.1.255.255<BR>115.1.1.0-115.1.1.255<BR>1.1.1.3<BR>100.99.1.3<BR><BR>
<BR>

<h4>Your Current IP: <span style="color: #009900;"><?php echo $_SERVER['REMOTE_ADDR']; ?></span></h4></td>
</tr>
</table>
</div>
