<?php
/*
Plugin Name: Shari Share Me
Plugin URI: http://www.phkcorp.com?do=wordpress
Description: Provides selective social network sharing of pages by using shortcodes. Add page sharing only to the pages you want!
Version: 1.0
Author: PHK Corporation
Author URI: http://www.phkcorp.com
*/

/*

	Copyright 2010  PHK Corporation  (email : phkcorp2005@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


//// Add page to options menu.
function addShariToManagementPage()
{
    // Add a new submenu under Options:
    add_options_page('Shari Share Me', 'Shari Share Me', 8, 'shari', 'displayShariManagementPage');
}

// Display the admin page.
function displayShariManagementPage()
{
	global $wpdb;

	if (is_admin()) {

?>
		<div class="wrap">
			<h2>Shari Share Me</h2>
			<p>Provides selective social network sharing of pages by using shortcodes. Add page sharing only to the pages you want!</p>
			<p>Social network sharing is great site traffic builder but when the social network icons do not show properly
on the page to be shared, for example, when you are in a secured session like any-to-any, this can be distracting
and you risk loosing a visitor and most importantly a valid external link to your website.</p>

			<p>Shari fixes this by putting the social network icons in a CSS file. Now the icons show in both secured and
unsecured page sessions.</p>

			<p>Shari is picky right now and only gives you a fixed selection of the major social networks. If you are nice to her (like
offer contributions), she may change her mind?</p>

			<p>The social networks offered include: Digg, Yahoo!, MSN Live, Facebook, Stumble, Technorati, Reddit and Newsvine</p>



				<fieldset class='options'>
					<legend><h2><u>Tips &amp; Techniques</u></h2></legend>
						<p>To use this plugin, simply insert the shortcode [shari] on the pages or posts
						that you want to enable visitor sharing.</p>
						<p>If you would like to change the icons with your own, requires uploading the new
						images to plugins/shari-share-me/images directory. You should use the same file names
						for the selected icons otherwise you will need to change the file names in the shari.php
						file.</p>
				</fieldset>

				<fieldset class='options'>
					<legend><h2><u>About the Architecture</u></h2></legend>
						<p>The key architecture uses CSS for icon reference, a PHP routine in conjunction with
						JavaScript to obtain and format the current page url that is sent to the social network.
						The social network is then launched in a separate window,</p>
				</fieldset>

				<fieldset class='options'>
					<legend><h2><u>Wordpress Development</u></h2></legend>
<p><a href="http://www.phkcorp.com" target="_blank">PHK Corporation</a> is available for custom Wordpress development which includes development of new plugins, modification
of existing plugins, migration of HTML/PSD/Smarty themes to wordpress-compliant <b>seamless</b> themes.</p>
<p>You may see our samples at <a href="http://www.phkcorp.com?do=wordpress" target="_blank">www.phkcorp.com?do=wordpress</a></p>
<p>Please email at <a href="mailto:phkcorp2005@gmail.com">phkcorp2005@gmail.com</a> or <a href="http://www.phkcorp.com?do=contact" target="_blank">www.phkcorp.com?do=contact</a> with your programming requirements.</p>
				</fieldset>

				<fieldset class='options'>
					<legend><h2><u>Plugin PHP Code</u></h2></legend>
<p>Here is the actual plugin code that provides the redirection.</p>
<p>
<code>
function selfURL() {<br/>
&nbsp;	$s = empty($_SERVER["HTTPS"]) ? ''<br/>
&nbsp;		: ($_SERVER["HTTPS"] == "on") ? "s"<br/>
&nbsp;		: "";<br/>
&nbsp;	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;<br/>
&nbsp;	$port = ($_SERVER["SERVER_PORT"] == "80") ? ""<br/>
&nbsp;		: (":".$_SERVER["SERVER_PORT"]);<br/>
&nbsp;	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];<br/>
}<br/>
function strleft($s1, $s2) {<br/>
&nbsp;	return substr($s1, 0, strpos($s1, $s2));<br/>
}<br/>
<br/>
<br/>
function show_shari_networks($atts, $content=null, $code="")<br/>
{<br/>
&nbsp;	$url = selfURL();<br/>
&nbsp;	$output = '<br/>
&nbsp;&nbsp;   &lt;style type="text/css"&gt;<br/>
&nbsp;&nbsp;	div.post_share_stuff {<br/>
&nbsp;&nbsp;        	background-image: url(/images/tbp_post_share_background_w_dot.gif);<br/>
&nbsp;&nbsp;	        background-repeat: repeat-x;<br/>
&nbsp;&nbsp;	        height:49px;<br/>
&nbsp;&nbsp;	        margin-top: 10px;<br/>
&nbsp;&nbsp;          padding:17px 3px;<br/>
&nbsp;&nbsp;	}<br/>
<br/>
&nbsp;&nbsp;	div.post_share_stuff ul {<br/>
&nbsp;&nbsp;	        list-style-type: none;<br/>
&nbsp;&nbsp;	        display: inline;<br/>
&nbsp;&nbsp;	        padding: 0px 0px 0px 0px;<br/>
&nbsp;&nbsp;	        margin-left:0px;<br/>
&nbsp;&nbsp;	}<br/>
<br/>
&nbsp;&nbsp;	div.post_share_stuff li {<br/>
&nbsp;&nbsp;	        display: inline;<br/>
&nbsp;&nbsp;	        padding-left:4px<br/>;
&nbsp;&nbsp;	        vertical-align: middle;<br/>
&nbsp;&nbsp;	        font-size: 11px;<br/>
&nbsp;&nbsp;	}<br/>
<br/>
&nbsp;&nbsp;	img {<br/>
&nbsp;&nbsp;		cursor:hand;<br/>
&nbsp;&nbsp;		vertical-align:middle;<br/>
&nbsp;&nbsp;	}<br/>
&nbsp;&nbsp;   &lt;/style&gt;<br/>
<br/>
&nbsp;&nbsp;   &lt;script language="JavaScript"&gt;<br/>
&nbsp;&nbsp;    function clipIt(url) {<br/>
&nbsp;&nbsp;&nbsp;        window.open(url +  document.title);<br/>
&nbsp;&nbsp;     }<br/>
&nbsp;&nbsp;   &lt;/script&gt;<br/>
<br/>
&nbsp;&nbsp;   &lt;div class="post_share_stuff"&gt;<br/>
&nbsp;&nbsp;   &lt;ul&gt;<br/>
&nbsp;&nbsp;		&lt;li&gt;&lt;img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/delicious.gif" alt="Add to del.icio.us" onclick="clipIt(\'http://del.icio.us/post?url='.$url.'&title=\')" /&gt;&lt;/li><br/>
&nbsp;&nbsp; 		&lt;li&gt;&lt;img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/google.gif" alt="Add to Google" onclick="clipIt(\'http://www.google.com/bookmarks/mark?op=edit&bkmk='.$url.'&title=\')"/&gt;&lt;/li><br/>
&nbsp;&nbsp;      	&lt;li&gt;&lt;img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/digg.gif" alt="Digg it" onclick="clipIt(\'http://www.digg.com/submit?phase=2&url='.$url.'&title=\')" /><&lt;li><br/>
&nbsp;&nbsp;      	&lt;li&gt;&lt;img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/yahoo.gif" alt="Add to Yahoo !" onclick="clipIt(\'http://myweb2.search.yahoo.com/myresults/bookmarklet?u='.$url.'&t=\')" /&gt;&lt;/li><br/>
&nbsp;&nbsp;      	&lt;li&gt;&lt;img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/live.gif" alt="Add to Windows Live" onclick="clipIt(\'https://favorites.live.com/quickadd.aspx?marklet=1&mkt=en-us&url='.$url.'&title=\')" /&gt;&lt;/li><br/>
&nbsp;&nbsp;      	&lt;li&gt;&lt;img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/facebook.gif" alt="Add to Facebook" onclick="clipIt(\'http://www.facebook.com/share.php?u='.$url.'&title=\')" /&gt;&lt;/li><br/>
&nbsp;&nbsp;      	&lt;li&gt;&lt;img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/stumble.gif" alt="Add to StumbleUpon" onclick="clipIt(\'http://www.stumbleupon.com/submit?url='.$url.'&title=\')" /&gt;&lt;/li><br/>
&nbsp;&nbsp;      	&lt;li&gt;&lt;img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/technorati.gif" alt="Technorati" onclick="clipIt(\'http://technorati.com/cosmos/search.html?url='.$url.'\')"&gt;&lt;/li><br/>
&nbsp;&nbsp;      	&lt;li&gt;&lt;img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/reddit.gif" alt="Reddit" onclick="clipIt(\'http://reddit.com/submit?url='.$url.'&title=\')"&gt;&lt;/li><br/>
&nbsp;&nbsp;      	&lt;li&gt;&lt;img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/newsvine.gif" alt="Newsvine" onclick="clipIt(\'http://www.newsvine.com/_tools/seed?popoff=0&u='.$url.'&headline=\')"&gt;&lt;/li><br/>
&nbsp;&nbsp;   &lt;/ul&gt;<br/>
&nbsp;&nbsp;   &lt;/div&gt;<br/>
&nbsp;&nbsp;	';<br/>
&nbsp;	return $output;<br/>
}<br/>
<br/>
//<br/>
// Hooks<br/>
//<br/>
<br/>
add_shortcode('shari', 'show_shari_networks');<br/>
add_action('admin_menu', 'addShariToManagementPage');<br/>
<br/>
</code>
</p>
				</fieldset>
<?php
	} // endif of is_admin()
}

function selfURL() {
	$s = empty($_SERVER["HTTPS"]) ? ''
		: ($_SERVER["HTTPS"] == "on") ? "s"
		: "";
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? ""
		: (":".$_SERVER["SERVER_PORT"]);
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}
function strleft($s1, $s2) {
	return substr($s1, 0, strpos($s1, $s2));
}


function show_shari_networks($atts, $content=null, $code="")
{
	$url = selfURL();

	$output = '
   <style type="text/css">
	div.post_share_stuff {
        	background-image: url(/images/tbp_post_share_background_w_dot.gif);

	        background-repeat: repeat-x;

	        height:49px;

	        margin-top: 10px;

	        padding:17px 3px;

	}



	div.post_share_stuff ul {

	        list-style-type: none;

	        display: inline;

	        padding: 0px 0px 0px 0px;

	        margin-left:0px;

	}



	div.post_share_stuff li {

	        display: inline;

	        padding-left:4px;

	        vertical-align: middle;

	        font-size: 11px;

	}

	img {
		cursor:hand;

		vertical-align:middle;
	}
   </style>

   <script language="JavaScript">
    function clipIt(url) {
        window.open(url +  document.title);
     }
   </script>

   <div class="post_share_stuff">
   <ul>
		<li><img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/delicious.gif" alt="Add to del.icio.us" onclick="clipIt(\'http://del.icio.us/post?url='.$url.'&title=\')" /></li>
 		<li><img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/google.gif" alt="Add to Google" onclick="clipIt(\'http://www.google.com/bookmarks/mark?op=edit&bkmk='.$url.'&title=\')"/></li>
      	<li><img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/digg.gif" alt="Digg it" onclick="clipIt(\'http://www.digg.com/submit?phase=2&url='.$url.'&title=\')" /></li>
      	<li><img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/yahoo.gif" alt="Add to Yahoo !" onclick="clipIt(\'http://myweb2.search.yahoo.com/myresults/bookmarklet?u='.$url.'&t=\')" /></li>
      	<li><img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/live.gif" alt="Add to Windows Live" onclick="clipIt(\'https://favorites.live.com/quickadd.aspx?marklet=1&mkt=en-us&url='.$url.'&title=\')" /></li>
      	<li><img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/facebook.gif" alt="Add to Facebook" onclick="clipIt(\'http://www.facebook.com/share.php?u='.$url.'&title=\')" /></li>
      	<li><img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/stumble.gif" alt="Add to StumbleUpon" onclick="clipIt(\'http://www.stumbleupon.com/submit?url='.$url.'&title=\')" /></li>
      	<li><img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/technorati.gif" alt="Technorati" onclick="clipIt(\'http://technorati.com/cosmos/search.html?url='.$url.'\')"></li>
      	<li><img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/reddit.gif" alt="Reddit" onclick="clipIt(\'http://reddit.com/submit?url='.$url.'&title=\')"></li>
      	<li><img src="'. get_bloginfo('wpurl') .'/wp-content/plugins/shari-share-me/images/newsvine.gif" alt="Newsvine" onclick="clipIt(\'http://www.newsvine.com/_tools/seed?popoff=0&u='.$url.'&headline=\')"></li>
   </ul>
   </div>
	';


	return $output;
}


//
// Hooks
//

add_shortcode('shari', 'show_shari_networks');
add_action('admin_menu', 'addShariToManagementPage');

?>