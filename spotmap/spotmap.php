<?php /*
Plugin Name: Spot Map
Plugin URI: http://www.anu.com
Description: Test widget
Author:Anu
Version: 1
Author URI: http://www.anu.com/*/

function spotmap_admin_option() 
{

	//include_once("extra.php");
	global $wpdb;
	echo "<div class='wrap'>";
	echo "<h2>"; 
	echo wp_specialchars( "Spot Map" ) ; 
	echo "</h2>";
    
	
	

   $table_name = $wpdb->prefix . "spotmap";

	$edit_id = ($_GET['edit_id']);
	$del_id = ($_GET['del_id']);
	
	$hid_id=$_REQUEST['hiddenid'];
	
	$spot_api = get_option('spot_api');
	$spot_width = get_option('spot_width');
	$spot_ht = get_option('spot_ht');
	$spot_lat = get_option('spot_lat');
	$spot_long = get_option('spot_long');
	$spot_title = get_option('spot_title');
	$spot_desc = get_option('spot_desc');
	$spot_link = get_option('spot_link');
	$spot_txtlink = get_option('spot_txtlink');
	
	if ($_POST['cd_submit']) 
	{
	$spot_lat = ($_POST['spot_lat']);
	$spot_width = ($_POST['spot_width']);
	$spot_ht = ($_POST['spot_ht']);
	$spot_api = ($_POST['spot_api']);
	$spot_long = ($_POST['spot_long']);
	$spot_title = ($_POST['spot_title']);
	$spot_desc = ($_POST['spot_desc']);
	$spot_link = ($_POST['spot_link']);
	$spot_txtlink = ($_POST['spot_txtlink']);
	
	update_option('spot_api', $spot_api );
	update_option('spot_width', $spot_width );
	update_option('spot_ht', $spot_ht );
	update_option('spot_lat', $spot_lat );
	update_option('spot_long', $spot_long );
	update_option('spot_title', $spot_title );
	update_option('spot_desc', $spot_desc );
	update_option('spot_link', $spot_link );
	update_option('spot_txtlink', $spot_txtlink );
	
			if($hid_id<>"" and  is_numeric($hid_id))
			{
				if($spot_lat!="" and $spot_long!="" and $spot_title!="") {	
				$query2 = "update $table_name set title='$spot_title',description='$spot_desc',latitude='$spot_lat'";
				$query2 = $query2 . " ,longitude='$spot_long', text='$spot_txtlink' , linktext='$spot_link' where id=$hid_id ";
				$users2 = mysql_query($query2);
				}
				echo"<script language='javascript'>";
				echo "window.location='".get_option('siteurl')."/wp-admin/options-general.php?page=spotmap/spotmap.php'";
				echo"</script>";
				
			}
			else
			{ 
		
				$spot_title = ($_POST['spot_title']);
				$spot_desc = ($_POST['spot_desc']);
				if($spot_lat!="" and $spot_long!="" and $spot_title!="") {
				$query1 = "insert into $table_name           
				 (title,latitude,longitude,text,linktext,description)
				    values
				('$spot_title','$spot_lat','$spot_long','$spot_txtlink','$spot_link','$spot_desc')";
				 $users1 = mysql_query($query1);
				}
		   }
		
	}
if ($_GET['doact']=="ed")
	{ 
	    $query = "SELECT * FROM $table_name where id=$edit_id";
        $users = mysql_query($query);
		$row = mysql_fetch_array($users);
	}
	if ($_GET['doact']=="del")
	{ 
	 $delquery ="delete from $table_name where id=$del_id";
     $resultdel= mysql_query($delquery);
	}
	
	?>
<!--<script type='text/javascript'>
/*function confirmDelete('get_option('siteurl')."/wp-admin/options-general.php?page=spotmap.php')
 {
  if (confirm("Are you sure you want to delete"))
   {
    document.location = 'get_option('siteurl')."/wp-admin/options-general.php?page=spotmap.php';
  }
}*/
</script>-->
	
<form name="cd_form" method="post" action="" >
<input name="hiddenid" type="hidden" id="hiddenid" value="<?php echo $edit_id; ?>">
<!--<input name="process" type="hidden" id="process" value="<?php //echo $process; ?>">-->

<table width="822" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <th align="left">Your ApiCode </th>
    <th align="left"><textarea name="spot_api" id="spot_api"><?php echo $spot_api;?></textarea>
   
   <a href=" http://code.google.com/apis/maps/signup.html" target="_blank"> http://code.google.com/apis/maps/signup.html</a></th>
  </tr>
  <tr>
    <th align="left">Width</th>
    <th align="left"><input name="spot_width" type="text" id="spot_width" value="<?php echo $spot_width;?>" /></th>
  </tr>
  <tr>
    <th align="left">Height</th>
    <th align="left"><input name="spot_ht" type="text" id="spot_ht" value="<?php echo $spot_ht;?>" /></th>
  </tr>
  <tr>
    <th width="233" align="left">Latitude</th>
    <th width="568" align="left"><input name="spot_lat" type="text" id="spot_lat" value="<?php echo $row['latitude'];?>" /></th>
  </tr>
  <tr>
    <th align="left">Longitude</th>
    <th align="left"><input name="spot_long" type="text" id="spot_long" value="<?php echo $row['longitude'];?>" /></th>
  </tr>
  <tr>
    <th align="left">Title</th>
    <th align="left"><input name="spot_title" type="text" id="spot_title" value="<?php echo $row['title'];?>"></th>
  </tr>
  <tr>
    <th align="left">Small Description </th>
    <th align="left"><textarea name="spot_desc" id="spot_desc"><?php echo $row['description'];?></textarea></th>
  </tr>
  <tr>
    <th align="left">Link</th>
    <th align="left"><input name="spot_link" type="text" id="spot_link" value="<?php echo $row['linktext'];?>" /></th>
  </tr>
  <tr>
    <th align="left">Text to link </th>
    <th align="left"><input name="spot_txtlink" type="text" id="spot_txtlink" value="<?php echo $row['text'];?>" /></th>
  </tr>
  <tr>
    <th align="left">Click this link to find latitude,longitude </th>
    <th align="left"><a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">http://universimmedia.pagesperso-orange.fr/geo/loc.htm</a></th>
  </tr>
  <tr>
    <th colspan="2" align="center"><input name="cd_submit" id="cd_submit" class="button-primary" value="Submit" type="submit" /></th>
  </tr>
  <tr>
   <td colspan="2">
  <table width="814">
  <tr>
    <th width="71" align="left">Latitude</th>
    <th width="80" align="left">Longitude</th>
    <th width="92" align="left">Title</th>
    <th width="200" align="left">Small Description</th>
    <th width="92" align="left">Link</th>
    <th width="159" align="left">Text to link </th>
    <th width="88" align="left">Action</th>
  </tr>
   
  <?php
//$rec_sel1 = $wpdb->get_results("SELECT * FROM $wpdb->trique ORDER BY id DESC");
//while($rows = mysql_fetch_array($rec_sel1))
$img_siteurl = get_option('siteurl');
$img_siteurl = $img_siteurl . "/wp-content/plugins/spotmap/";
$sql="SELECT * FROM $table_name ORDER BY id DESC";
$resultshow=mysql_query($sql);
while($rows = mysql_fetch_array($resultshow))
{
 ?>
  <tr>
    <td><?php echo $rows['latitude']; ?></td>
    <td><?php echo $rows['longitude']; ?></td>
    <td><?php echo $rows['title']; ?></td>
    <td><?php echo $rows['description']; ?></td>
    <td><?php echo $rows['linktext']; ?></td>
    <td><?php echo $rows['text']; ?></td>
    <td><a href="options-general.php?page=spotmap/spotmap.php&doact=ed&edit_id=<?php echo $rows['id']; ?>">Edit</a> | <a href="options-general.php?page=spotmap/spotmap.php&doact=del&del_id=<?php echo $rows['id'];?>"  onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>
    <!--<td> |<a href="<?php //echo wp_login_url(get_option('siteurl')."/wp-admin"); ?>" title="Login">Login</a>
</td>
<td> |<a href="<?php //echo wp_logout_url(get_option('siteurl')); ?>" title="Logout">Logout</a>
</td>
</tr>-->
    <?php 

}
?>
</table></td>
 </tr>
</table>

<?php
	echo "</div>";
}

function spotmap_callback( $content ) {
	global $wpcf_strings;
  global $wpdb;

   $table_name = $wpdb->prefix . "spotmap";
	/* Run the input check. */		
	if(false === strpos($content, '<!--spotmap form-->')) {
		return $content;
	}
	
	
		$query = "SELECT * FROM $table_name ORDER BY id DESC";
$users = mysql_query($query);

$spot_api = get_option('spot_api');
$spot_ht = get_option('spot_ht');
$spot_width = get_option('spot_width');
$img_siteurl = get_option('siteurl');
$img_siteurl = $img_siteurl . "/wp-content/plugins/spotmap/";?>
<script type="text/javascript" src="<?php echo $img_siteurl;?>jquery.cycle.all.mine.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $spot_api;?>"></script>
<script type="text/javascript">
window.onscroll = function()
{
	if( window.XMLHttpRequest ) {
		if (document.documentElement.scrollTop > 779 || self.pageYOffset > 779) {
			$('map').style.position = 'fixed';
			$('map').style.top = '0';
		} else if (document.documentElement.scrollTop < 779 || self.pageYOffset < 779) {
			$('map').style.position = 'absolute';
			$('map').style.top = '100px';
		}
	}
}
</script>

	<script type="text/javascript">
	
jQuery.noConflict();

/* JavaScript Document
 * jQuery gMap
 *
 * @url		http://gmap.nurtext.de/
 * @author	Cedric Kastner <cedric@nur-text.de>
 * @version	1.0.3
 */
(function($)
{
	// Main plugin function
	$.fn.gMap = function(options)
	{
		// Check if the browser is compatible with Google Maps
		if (!window.GBrowserIsCompatible || !GBrowserIsCompatible()) return this;
		// Build main options before element iteration
		var opts = $.extend({}, $.fn.gMap.defaults, options);
		// Iterate each matched element
		return this.each(function()
		{
			// Create new map and set initial options
			$gmap = new GMap2(this);
			// Try to center to the first marker
			if (!opts.latitude && !opts.longitude)
			{
				// Check for at least one marker
				if (is_array(opts.markers) && opts.markers.length >= 1)
				{
					// Center to the first marker
					opts.latitude  =  opts.markers[0].latitude;
					opts.longitude =  opts.markers[0].longitude;
				}
				else
				{
					// Center Earth and lower zoom
					opts.latitude = 34.885931;
					opts.longitude = 9.84375;
					opts.zoom = 2;
					
				}
			}
			// Center the map and set the maptype
			$gmap.setCenter(new GLatLng(opts.latitude, opts.longitude), opts.zoom);
			$gmap.setMapType(opts.maptype);
			
			// Check for custom map controls
			if (opts.controls.length == 0)
			{
				// Default map controls
				$gmap.setUIToDefault();
				
			}
			else
			{
				// Add custom map controls
				for (var i = 0; i < opts.controls.length; i++)
				{
					// Eval is evil - I know. ;)
					eval('$gmap.addControl(new ' + opts.controls[i] + '());');
				}
			}	
			// Check if scrollwheel should be enabled when using custom controls
			if (opts.scrollwheel == true && opts.controls.length != 0) { $gmap.enableScrollWheelZoom(); }
			// Add all map markers
			for (var j = 0; j < opts.markers.length; j++)
			{
				// Get the options from current marker
				marker = opts.markers[j];
				// Create new icon
				gicon = new GIcon();
				// Set icon properties from global options
				gicon.image = opts.icon.image;
				gicon.shadow = opts.icon.shadow;
				gicon.iconSize = (is_array(opts.icon.iconsize)) ? new GSize(opts.icon.iconsize[0], opts.icon.iconsize[1]) : opts.icon.iconsize;
				gicon.shadowSize = (is_array(opts.icon.shadowsize)) ? new GSize(opts.icon.shadowsize[0], opts.icon.shadowsize[1]) : opts.icon.shadowsize;
				gicon.iconAnchor = (is_array(opts.icon.iconanchor)) ? new GPoint(opts.icon.iconanchor[0], opts.icon.iconanchor[1]) : opts.icon.iconanchor;
				gicon.infoWindowAnchor = (is_array(opts.icon.infowindowanchor)) ? new GPoint(opts.icon.infowindowanchor[0], opts.icon.infowindowanchor[1]) : opts.icon.infowindowanchor;
				if (marker.icon)
				{
					// Overwrite global options with ther marker one's
					gicon.image = marker.icon.image;
					gicon.shadow = marker.icon.shadow;
					gicon.iconSize = (is_array(marker.icon.iconsize)) ? new GSize(marker.icon.iconsize[0], marker.icon.iconsize[1]) : marker.icon.iconsize;
					gicon.shadowSize = (is_array(marker.icon.shadowsize)) ? new GSize(marker.icon.shadowsize[0], marker.icon.shadowsize[1]) : marker.icon.shadowsize;
					gicon.iconAnchor = (is_array(marker.icon.iconanchor)) ? new GPoint(marker.icon.iconanchor[0], marker.icon.iconanchor[1]) : marker.icon.iconanchor;
					gicon.infoWindowAnchor = (is_array(marker.icon.infowindowanchor)) ? new GPoint(marker.icon.infowindowanchor[0], marker.icon.infowindowanchor[1]) : marker.icon.infowindowanchor;
					
				}			
				// Create a new marker on the map
				gmarker = new GMarker(new GPoint(marker.longitude, marker.latitude), gicon);
				
				// Only display info window if the marker contains a description
				if (marker.html)
				{
					// Bind the info window to marker
					gmarker.bindInfoWindowHtml(opts.html_prepend + marker.html + opts.html_append);
					// Add overlay if marker was created and check if popup should be shown when map is loaded
					if (gmarker) { $gmap.addOverlay(gmarker); }
					if (marker.popup == true) { gmarker.openInfoWindowHtml(opts.html_prepend + marker.html + opts.html_append); }
				}
				else
				{
					// Add overlay marker
					if (gmarker) { $gmap.addOverlay(gmarker); }
				}
			}
		});
	}
	// Function to check if array or not
	function is_array(input)
	{
		return typeof(input) == 'object' && (input instanceof Array);
  	}
	// Set default settings
	$.fn.gMap.defaults =
	{
		latitude:				0,
		longitude:				0,
		zoom:					6,
		markers:				[],
		controls:				[],
		scrollwheel:			true,
		maptype:				G_NORMAL_MAP,
		html_prepend:			'<div class="gmap_marker">',
		html_append:			'</div>',
		icon:
		{
			image:				"http://www.google.com/mapfiles/marker.png",
			shadow:				"http://www.google.com/mapfiles/shadow50.png",
			iconsize:			[20, 34],
			shadowsize:			[37, 34],
			iconanchor:			[9, 34],
			infowindowanchor:	[9, 2]
		}
	}
})(jQuery);


/* Inititalize Google Map */
jQuery(document).ready(function() {
	jQuery("#map").gMap({ 
			markers: [
					  <?php
	$cnt=mysql_num_rows($users);
	$ct=0;
	while($row = mysql_fetch_array($users)){
	$ct=$ct+1;
	$str="<table width='200' border='0' cellpadding='0' cellspacing='0'><tr><td align='center'>".$row['title']."</td></tr>";
    $str=$str."<tr><td>".$row['description']."</td></tr>";
    $str=$str."<tr><td><a href='".$rows['linktext']."' target='_blank'>".$row['text']."</a></td></tr></table>";
	?>
					  { latitude: <?php echo $row['latitude'];?>,
					  	longitude: <?php echo $row['longitude'];?>,
						html: "<?php echo $str;?>"
						} <?php if($cnt!=$ct) {?>, <?php } ?>
			<?php } ?>		 
					],
			latitude: 18.170906,
			longitude: 84.272459,
			zoom: 4,
			controls: ["GSmallMapControl", "GMapTypeControl"]
	});


});
	
	</script>
	
	<?php
	
	$form=$form."<div id='map' style='width:".$spot_width."px;height:".$spot_ht."px;'> </div>";
	/*$form=$form. "</div>";       
	$form=$form."</div>";*/
        return str_replace('<!--spotmap form-->', $form, $content);
   // }
}

function spotmap_install () {
    
   global $wpdb;
add_option('spot_api', "ABQIAAAA5IeqnlU9cAnczbRwV2BzMBROeljkKaBjt4BdvT9dijGbBOfJlhSlKyiqraYI3PUXNiz1Gi4d9laq4A"); 
add_option('spot_ht', "500"); 
add_option('spot_width', "600"); 
   $table_name = $wpdb->prefix . "spotmap";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

  
  $sql = "CREATE TABLE " . $table_name . " (
	  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	  title VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	  latitude VARCHAR( 255 ) NOT NULL,
	  longitude VARCHAR( 255 ) NOT NULL,
	  text VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	  linktext VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	  description text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
	  );";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);


 /*$cd_name = "Mr. Wordpress";
  $cd_description = "Congratulations, you just completed the installation!";

  $rows_affected = $wpdb->insert( $table_name, array( 'name' => $cd_name, 'description' => $cd_description ) );*/

  
  }
 }






function spotmap_add_to_menu() 
{
 add_options_page('Spot Map', 'Spot Map', 3, __FILE__, 'spotmap_admin_option' );
}

add_action('admin_menu', 'spotmap_add_to_menu');
register_activation_hook(__FILE__, 'spotmap_install');
add_filter('the_content', 'spotmap_callback', 7);




?>
