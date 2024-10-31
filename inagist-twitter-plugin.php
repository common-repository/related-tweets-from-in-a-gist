<?php
/*
Plugin Name: Inagist Twitter Plugin
Plugin URI: http://inagist.com
Description: Display Related Tweets for below every post on your blog
Version: 1.0
Author: Pankaj kothari.
Author URI: http://pankajkothari.com/
*/

function inagist_init() {
	add_action('admin_menu', 'inagist_config_page');
}
add_action('init', 'inagist_init');

function inagist_config_page() {
	if ( function_exists('add_submenu_page') )
		add_submenu_page('plugins.php', __('Inagist Configuration'), __('Inagist Configuration'), 'manage_options', 'inagist-key-config', 'inagist_conf');

}


function inagist_conf() {

if(!empty($_POST))
{
	//print_r($_POST);
	$title=$_POST['wd_title'];
	$twtuser=$_POST['wd_user'];
	$clientid=$_POST['wd_clientid'];
	$width=$_POST['wd_width'];	
	$height=$_POST['wd_height'];
	$bgcolor=str_replace("#","",$_POST['wd_bg_color']);
	$tcolor=str_replace("#","",$_POST['wd_tweet_color']);
	$bcolor=str_replace("#","",$_POST['wd_border_color']);
	$lcolor=str_replace("#","",$_POST['wd_link_color']);	
	$keywords=$_POST['wd_keyw'];
	$customcss=$_POST['wd_css'];
	$twtcnt=$_POST['wd_twtcnt'];
	$enablereply=$_POST['wd_reply'];
	$googleanalyticsid=$_POST['wd_goog'];
	$excludewords=$_POST['wd_exclude'];
}
else
{
	$title=get_option("inagist_plugin_title");
	if ($title=='')
		$title="Related Tweets";
		
	$twtuser=get_option("inagist_plugin_user");
	
	$clientid=get_option("inagist_plugin_clientid");
	
	$width=get_option("inagist_plugin_width");
	if ($width=='')
		$width="300";
			
	$height=get_option("inagist_plugin_height");
	if ($height=='')
		$height="500";
		
	$bgcolor=get_option("inagist_plugin_bgcolor");
	if ($bgcolor=='')
		$bgcolor="FFFFFF";
		
	$tcolor=get_option("inagist_plugin_tcolor");
	if ($tcolor=='')
		$tcolor="222222";
			
	$bcolor=get_option("inagist_plugin_bcolor");
	if ($bcolor=='')
		$bcolor="eeeeee";
		
	$lcolor=get_option("inagist_plugin_lcolor");
	if ($lcolor=='')
		$lcolor="0000AA";
		
	$customcss=get_option("inagist_plugin_css");		
	$keywords=get_option("inagist_plugin_default_keyw");
	$enablereply=get_option("inagist_plugin_reply");
	$googleanalyticsid=get_option("inagist_plugin_google");
	$excludewords=get_option("inagist_plugin_exclude");
	
	$twtcnt=get_option("inagist_plugin_twtcnt");
	if ($twtcnt=='')
		$twtcnt="20";
	
}

?>
<h2><?php _e('Inagist Configuration'); ?></h2>
<div id="colorpicker301" class="colorpicker301" style="position: absolute; left:50%;top:50%;"></div>
<form method="post" action="">    
            <table width="100%" cellspacing="2" cellpadding="1" border="0">
	<tbody>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Widget Title </td>
			<td class="fieldInputStyle"><input type="text"
				style="text-align: left;" value="<?=$title?>" maxlength="255" size="25"
				name="wd_title"/> <br/>
			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Inagist Partner id </td>
			<td class="fieldInputStyle"><input type="text"
				style="text-align: left;" value="<?=$clientid?>" maxlength="255" size="25"
				name="wd_clientid"/> <br/>
			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Twitter User </td>
			<td class="fieldInputStyle"><input type="text"
				style="text-align: left;" value="<?=$twtuser?>" maxlength="255" size="25"
				name="wd_user"/> <br/>
			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Widget Width </td>
			<td class="fieldInputStyle"><input type="text"
				style="text-align: left;" value="<?=$width?>" maxlength="4" size="7"
				name="wd_width"/> <br/>
			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Widget Height </td>
			<td class="fieldInputStyle"><input type="text"
				style="text-align: left;" value="<?=$height?>" maxlength="4" size="7"
				name="wd_height"/> <br/>
			</td>
		</tr>
		
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Background
			Colour</td>
			<td class="fieldInputStyle"><input type="text"
				onblur="JavaScript:document.getElementById('wd_bg_color4').style.backgroundColor = this.value;"
				value="<?='#'.$bgcolor?>" maxlength="7" id="wd_bg_color" size="8"
				name="wd_bg_color"/>&nbsp;<input type="text"
				style="background-color: <?='#'.$bgcolor?>;" id="wd_bg_color4"
				name="wd_bg_color4" size="1"/>&nbsp;<a href="#"
				onclick="showColorGrid3('wd_bg_color','wd_bg_color4');" name="pick2"
				id="pick2">Pick</a> <br/>

			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Tweet
			Colour</td>
			<td class="fieldInputStyle"><input type="text"
				onblur="JavaScript:document.getElementById('wd_tweet_color4').style.backgroundColor = this.value;"
				value="<?='#'.$tcolor?>" maxlength="7" id="wd_tweet_color" size="8"
				name="wd_tweet_color"/>&nbsp;<input type="text"
				style="background-color: <?='#'.$tcolor?>;" id="wd_tweet_color4"
				name="wd_tweet_color4" size="1"/>&nbsp;<a href="#"
				onclick="showColorGrid3('wd_tweet_color','wd_tweet_color4');"
				name="pick2" id="pick2">Pick</a> <br/>

			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Border
			Colour</td>
			<td class="fieldInputStyle"><input type="text"
				onblur="JavaScript:document.getElementById('wd_border_color4').style.backgroundColor = this.value;"
				value="<?='#'.$bcolor?>" maxlength="7" id="wd_border_color" size="8"
				name="wd_border_color"/>&nbsp;<input type="text"
				style="background-color: <?='#'.$bcolor?>;" id="wd_border_color4"
				name="wd_border_color4" size="1"/>&nbsp;<a href="#"
				onclick="showColorGrid3('wd_border_color','wd_border_color4');"
				name="pick2" id="pick2">Pick</a> <br/>

			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Links Colour
			</td>
			<td class="fieldInputStyle"><input type="text"
				onblur="JavaScript:document.getElementById('wd_link_color4').style.backgroundColor = this.value;"
				value="<?='#'.$lcolor?>" maxlength="7" id="wd_link_color" size="8"
				name="wd_link_color"/>&nbsp;<input type="text"
				style="background-color: <?='#'.$lcolor?>;" id="wd_link_color4"
				name="wd_link_color4" size="1"/>&nbsp;<a href="#"
				onclick="showColorGrid3('wd_link_color','wd_link_color4');"
				name="pick2" id="pick2">Pick</a> <br/>

			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Custom css file path</td>
			<td class="fieldInputStyle"><input type="text"
				style="text-align: left;" value="<?=$customcss?>" maxlength="255" size="25"
				name="wd_css"/> <br/>
			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Default Keywords </td>
			<td class="fieldInputStyle"><input type="text"
				style="text-align: left;" value="<?=$keywords?>" maxlength="255" size="25"
				name="wd_keyw"/> <br/>
			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Exclude Words </td>
			<td class="fieldInputStyle"><input type="text"
				style="text-align: left;" value="<?=$excludewords?>" maxlength="255" size="25"
				name="wd_exclude"/> <br/>
			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Google Analytics Id </td>
			<td class="fieldInputStyle"><input type="text"
				style="text-align: left;" value="<?=$googleanalyticsid?>" maxlength="255" size="25"
				name="wd_goog"/> <br/>
			</td>
		</tr>		
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Maximum number of tweets to show </td>
			<td class="fieldInputStyle">
			<select name="wd_twtcnt">
			<?php
			for($i=1;$i<=50;++$i)
				echo "<option value='$i'" . ( $twtcnt == $i ? "selected='selected'" : '' ) . ">$i</option>"; 
			?>
			</select>
			<br/>
			</td>
		</tr>
		<tr>
			<td width="25%" valign="top" class="fieldLabelRight">Enable Replies </td>
			<td class="fieldInputStyle">
			<input type="checkbox" style="text-align: left;" <?php if ($enablereply) echo " checked=checked ";?>" value="1" name="wd_reply"/> <br/>
			</td>
		</tr>
		<tr>
			<td align="left" colspan="2">
			<input type="submit" class="stdButton" value="Preview" name="Submit"/> 
			<input type="submit" class="stdButton" value="Save" name="Submit"/>
			</td>
		</tr>
	</tbody>
</table>
</form>
<?php            
if ($_POST['Submit']=='Preview')
{	
?>
	<div class="widget_preview">
    <script language="javascript">
		var inagist_ch_client = "<?=$clientid?>";
		var inagist_ch_bgcolor = "<?=$bgcolor?>";
		var inagist_ch_tcolor = "<?=$tcolor?>";
		var inagist_ch_lcolor = "<?=$lcolor?>";
		var inagist_ch_bcolor = "<?=$bcolor?>";
		var inagist_ch_width="<?=$width?>";
		var inagist_ch_height="<?=$height?>";
		var inagist_ch_user="<?=$twtuser?>";
		var inagist_ch_title="<?=$title?>";
		var inagist_ch_keywords="<?=$keywords?>";
		var inagist_ch_css="<?=$customcss?>";
		var inagist_ch_reply="<?=$enablereply?>";
		var inagist_ch_twtcnt="<?=$twtcnt?>";
		var inagist_ch_google="<?=$googleanalyticsid?>";
	</script>
	<script type="text/javascript" src="http://inagist.com/netroy/js/show_channel.js"></script>
	</div>
    <?php 
}
else if ($_POST['Submit']=='Save')
{
	update_option("inagist_plugin_title",$_POST['wd_title']);
	update_option("inagist_plugin_user",$_POST['wd_user']);
	update_option("inagist_plugin_clientid",$_POST['wd_clientid']);
	update_option("inagist_plugin_width",$_POST['wd_width']);	
	update_option("inagist_plugin_height",$_POST['wd_height']);
	update_option("inagist_plugin_bgcolor",str_replace("#","",$_POST['wd_bg_color']));
	update_option("inagist_plugin_tcolor",str_replace("#","",$_POST['wd_tweet_color']));
	update_option("inagist_plugin_bcolor",str_replace("#","",$_POST['wd_border_color']));
	update_option("inagist_plugin_lcolor",str_replace("#","",$_POST['wd_link_color']));
	update_option("inagist_plugin_css",$_POST['wd_css']);	
	update_option("inagist_plugin_default_keyw",$_POST['wd_keyw']);
	update_option("inagist_plugin_reply",$_POST['wd_reply']);
	update_option("inagist_plugin_twtcnt",$_POST['wd_twtcnt']);
	update_option("inagist_plugin_google",$_POST['wd_goog']);
	update_option("inagist_plugin_exclude",$_POST['wd_exclude']);
}

}

function wp_inagist_plugin_related_tweets()
{
	if(is_single())
	{
		$title=get_option("inagist_plugin_title");
		if ($title=='')
			$title="Related Tweets";			
		$twtuser=get_option("inagist_plugin_user");	
		$clientid=get_option("inagist_plugin_clientid");	
		$width=get_option("inagist_plugin_width");
		if ($width=='')
			$width="300";				
		$height=get_option("inagist_plugin_height");
		if ($height=='')
			$height="500";			
		$bgcolor=get_option("inagist_plugin_bgcolor");
		if ($bgcolor=='')
			$bgcolor="FFFFFF";			
		$tcolor=get_option("inagist_plugin_tcolor");
		if ($tcolor=='')
			$tcolor="222222";				
		$bcolor=get_option("inagist_plugin_bcolor");
		if ($bcolor=='')
			$bcolor="eeeeee";			
		$lcolor=get_option("inagist_plugin_lcolor");
		if ($lcolor=='')
			$lcolor="0000AA";			
		$customcss=get_option("inagist_plugin_css");		
		$keywords=get_option("inagist_plugin_default_keyw");
		$enablereply=get_option("inagist_plugin_reply");
		$googleanalyticsid=get_option("inagist_plugin_google");
		$excludewords=strtolower(get_option("inagist_plugin_exclude"));
		$excludearray=array();
		
		if ($excludewords!='')
			$excludearray=explode("|",$excludewords);
		
		$twtcnt=get_option("inagist_plugin_twtcnt");
		if ($twtcnt=='')
			$twtcnt="20";
			
		$keyW = '';
		foreach (get_the_tags() as $tag){
			$tagvar = $tag->name;
			if (!in_array(strtolower($tagvar),$excludearray))
				$keyW .= "{$tag->name}|";
		}
		if (substr($keyW, -1) == '|')
			$keyW = substr($keyW, 0, -1);
		if ($keyW!='')		
			$keywords=$keyW;
			
		$output = '
		<div class="widget_preview" style="padding-bottom:20px;">
    	<script language="javascript">
		var inagist_ch_client = "'.$clientid.'";
		var inagist_ch_bgcolor = "'.$bgcolor.'";
		var inagist_ch_tcolor = "'.$tcolor.'";
		var inagist_ch_lcolor = "'.$lcolor.'";
		var inagist_ch_bcolor = "'.$bcolor.'";
		var inagist_ch_width="'.$width.'";
		var inagist_ch_height="'.$height.'";
		var inagist_ch_user="'.$twtuser.'";
		var inagist_ch_title="'.$title.'";
		var inagist_ch_keywords="'.$keywords.'";
		var inagist_ch_css="'.$customcss.'";
		var inagist_ch_reply="'.$enablereply.'";
		var inagist_ch_twtcnt="'.$twtcnt.'";
		var inagist_ch_google="'.$googleanalyticsid.'";
		</script>
		<script type="text/javascript" src="http://inagist.com/netroy/js/show_channel.js"></script>
		</div>';
	 	//$content .= $output;
	}
	return $output;
}

wp_register_script('color_picker', get_bloginfo('wpurl') . '/wp-content/plugins/inagist-twitter-widget/color.js',null,'1.0' );
wp_enqueue_script('color_picker');

//add_action('comment_text','wp_inagist_plugin_related_tweets');
