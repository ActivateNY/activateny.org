<?php
/**
* Admin DC plugins
* Version 1.0.1
*/

if(!class_exists('dcwp_plugin_admin_dcsmt')) {

	class dcwp_plugin_admin_dcsmt {

		var $hook 		= '';
		var $filename	= '';
		var $longname	= '';
		var $shortname	= '';
		var $optionname = '';
		var $homepage	= '';
		var $accesslvl	= 'manage_options';

		function __construct() {

			add_filter("plugin_action_links_{$this->filename}", array(&$this,'add_settings_link'));
			add_action('admin_menu', array(&$this,'add_option_page'));
			add_action("admin_print_styles-settings_page_{$this->hook}",array(&$this,'add_admin_styles'));
			add_action("admin_print_scripts-settings_page_{$this->hook}",array(&$this,'add_admin_scripts'));
		}

		function add_admin_styles() {

			wp_enqueue_style("dcwp_plugin_admin_dcsmt_css", WP_CONTENT_URL . "/plugins/" . plugin_basename(dirname($this->filename)). "/css/dcsmt_admin.css");

		}

		function add_admin_scripts() {

			wp_enqueue_script('postbox');
			wp_enqueue_script('jquery');
			wp_enqueue_style('dcwp_plugin_admin_dcsmt_jquery', WP_CONTENT_URL . '/plugins/' . plugin_basename(dirname($this->filename)). '/js/jquery.admin.js');

		}

		function add_option_page() {

			add_options_page($this->longname, $this->shortname, $this->accesslvl, $this->hook, array(&$this,'option_page'));

		}

		function add_settings_link($links) { 

			$settings_link = '<a href="options-general.php?page='.$this->hook.'">Settings</a>'; 

			array_unshift($links, $settings_link); 

			return $links; 

		}
		
		function dcwp_premium() {
			
			$icons = '<img src="'.dc_jqsocialmediatabs::get_plugin_directory() . '/inc/images/';
			
			$content = '<div class="premium-ad"><a href="http://www.designchemical.com/blog/index.php/premium-wordpress-plugins/premium-wordpress-plugin-social-network-tabs/" target="_blank"><img src="'.dc_jqsocialmediatabs::get_plugin_directory() . '/inc/images/dcsnt_250_125.png" alt="Wordpress Social Network Tabs" /></a></div>';
			$content .= '<p><strong>Includes 17 social networks with 70 feed options:</strong></p>';
			$content .= '<ul class="premium-list">
			<li>'.$icons.'twitter.png" alt="" />Twitter Latest Tweets &#8211; Profile, Twitter List or Search</li>
<li>'.$icons.'google.png" alt="" />Google Latest +1s</li>
<li>'.$icons.'facebook.png" alt="" />Facebook Page Wall Posts</li>
<li>'.$icons.'facebook.png" alt="" />Facebook Like Box/Stream</li>
<li>'.$icons.'facebook.png" alt="" />Facebook Recommendations</li>
<li>'.$icons.'instagram.png" alt="" />Instagram &#8211; User Feed, Search, Location Feed or Location Search</li>
<li>'.$icons.'linkedin.png" alt="" />LinkedIn - Company Profile, Member Profile, Company Insider &#038; Jobs Plugins</li>
<li>'.$icons.'tumblr.png" alt="" />Tumblr Latest Posts</li>
<li>'.$icons.'youtube.png" alt="" />Youtube Latest Uploads/Favorites & Playlists</li>
<li>'.$icons.'vimeo.png" alt="" />Vimeo Likes/Videos/Appeared In/Albums/Channels/Groups</li>
<li>'.$icons.'delicious.png" alt="" />Delicious Latest Bookmarks</li>
<li>'.$icons.'digg.png" alt="" />Latest Diggs</li>
<li>'.$icons.'pinterest.png" alt="" />Pinterest Pins</li>
<li>'.$icons.'flickr.png" alt="" />Flickr Gallery</li>
<li>'.$icons.'rss.png" alt="" />RSS Latest Posts</li>
<li>'.$icons.'dribbble.png" alt="" />Dribbble Latest Shots or Likes</li>
<li>'.$icons.'stumbleupon.png" alt="" />Stumbleupon Favorites/Reviews</li>
<li>'.$icons.'lastfm.png" alt="" />Last.fm Loved/Recent/Reply Tracker</li>
<li>'.$icons.'deviantart.png" alt="" />Deviantart Latest Posts</li>';
			$content .= '</ul>';
			$content .= '<p><a href="http://www.designchemical.com/blog/index.php/premium-wordpress-plugins/premium-wordpress-plugin-social-network-tabs/" target="_blank">Check out the demo site!</a></p>';
			$this->postbox($this->hook.'-premium','Upgrade to our PRO version <a href="http://www.designchemical.com/blog/index.php/premium-wordpress-plugins/premium-wordpress-plugin-social-network-tabs/" target="_blank">Social Network Tabs</a>',$content);		

		}

		function latest_posts() {

			require_once(ABSPATH.WPINC.'/rss.php');  
			if ( $rss = fetch_rss( 'http://feeds.feedburner.com/DesignChemical' ) ) {

				$content = '<ul class="dcwp-rss">';
				$rss->items = array_slice( $rss->items, 0, 5 );
				foreach ( (array) $rss->items as $item ) {

					$content .= '<li class="dcwp-rss-item">';
					$content .= '<a target="_blank" href="'.clean_url( $item['link'], $protocolls=null, 'display' ).'">'. $item['title'] .'</a> ';
					$content .= '</li>';
				}
				$content .= '</ul><ul class="bullet">';
				$content .= '<li class="dcwp-icon-rss"><a href="http://feeds.feedburner.com/DesignChemical">Subscribe to our RSS feed</a></li>';
				$content .= '</ul>';

			} else {

				$content = '<p>No updates..</p>';
			}

			$this->postbox($this->hook.'-latestpostbox','Latest news from Design Chemical ...',$content);
		}

		function likebox(){

			$content = '<p><a href="https://twitter.com/'.$this->twitter.'" class="twitter-follow-button" '.$count.' data-lang="en">Follow @'.$this->twitter.'</a><script src="//platform.twitter.com/widgets.js" type="text/javascript"></script></p>';
			$content .= '<ul class="bullet">';
			$content .= '<li><a href="http://wordpress.org/extend/plugins/'.$this->hook.'/" target="_blank"><strong>Rate it 5</strong></a> on the WordPress.org Plugin Directory</a></li>';
			$content .= '<li>Check out our other plugins - <a target="_blank" href="http://www.designchemical.com/blog/">Design Chemical</a></li></ul>';
			$content .= '<ul id="dc-share">';
			$content .= '<li id="dcssb-twitter"><a href="http://twitter.com/share" data-url="'.$this->homeshort.'" data-counturl="'.$this->homepage.'" data-text="'.$this->title.'" class="twitter-share-button" data-count="vertical" data-via="'.$this->twitter.'"></a></li>';
			$content .= '<li><iframe src="http://www.facebook.com/plugins/like.php?app_id='.$appId.'&amp;href='.urlencode($this->homepage).'&amp;send=false&amp;layout=box_count&amp;width=48&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:48px; height:62px;" allowTransparency="true"></iframe></li>';
			$content .= '<li id="dcssb-plusone"><g:plusone size="tall" href="'.$this->homepage.'" count="true"></g:plusone></li><script type="text/javascript">
				(function() {
					var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
					po.src = "https://apis.google.com/js/plusone.js";
					var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
				})();
				</script>';
			$content .= '<li id="dcssb-stumble"><script src="http://www.stumbleupon.com/hostedbadge.php?s=5&r='.$this->homepage.'"></script></li>';
			$content .= '<li id="dcssb-pinit"><a href="http://pinterest.com/pin/create/button/?url='.urlencode($this->homepage).'&media='.urlencode($this->imageurl).'&description='.urlencode($this->description).'" class="pin-it-button" count-layout="vertical">Pin It</a>';
			$content .= '<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script></li>';
			$content .= '<li id="dcssb-linkedin"><script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-url="'.$this->homepage.'" data-counter="top"></script></li>';
			$content .= '<script type="text/javascript">
(function() {
var s = document.createElement("SCRIPT"), s1 = document.getElementsByTagName("SCRIPT")[0];
s.type = "text/javascript";
s.async = true;
s.src = "http://widgets.digg.com/buttons.js";
s1.parentNode.insertBefore(s, s1);
})();
</script>';
			$content .= '<li id="dcssb-digg"><a href="http://digg.com/submit?url='.urlencode($this->homepage).'&amp;title='.urlencode($this->title).'" class="DiggThisButton DiggMedium"><span style="display: none;">'.$this->description.'</span></a></li>';
			$content .= '<li id="dcssb-reddit"><script type="text/javascript">
							  reddit_url = "'.$this->homepage.'";
							  reddit_title = "'.$this->title.'";
							  reddit_newwindow="1"
							  </script>
							  <script type="text/javascript" src="http://www.reddit.com/static/button/button2.js"></script></li>';
			$content .= '</ul><div class="clear"></div>';
			$content .= '<form name="_xclick" id="form-dcwp-donate" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">';
			$content .= '<input type="hidden" name="cmd" value="_s-xclick">';
			$content .= '<input type="hidden" name="hosted_button_id" value="NVWNM7CSNMEHY">';
			$content .= '<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/nl_NL/i/scr/pixel.gif" width="1" height="1">';
			$content .= '</form>';

			$this->postbox($this->hook.'-likebox','Share it, rate it, tell your friends!',$content);
		}

		function support_box() {

			$content = '<ul class="bullet">';
			$content .= '<li>Trouble installing or setting-up?</li>';
			$content .= '<li>Need help on customising the styles?</li>';
			$content .= '<li>Have a suggestion on how it can be improved?</li></ul>';
			$content .= '<p>Check out some of the solutions or contact us directly via the <a target="_blank" href="'.$this->homepage.'">plugin home page</a>.';

			$this->postbox($this->hook.'-support-box',"Need any help with ".$this->shortname."?",$content);

		}

		function postbox($id,$title,$content){

			?>

			<div id="<?php echo $id; ?>" class="postbox dcwp-box">				
				<h3 class="hndle"><span><?php echo $title; ?></span></h3>
				<div class="inside">
					<?php echo $content; ?>
				</div>
			</div>

			<?php			

		}

		function setup_admin_page($title,$subtitle) {

			?>

			<div class="wrap">
			  <h2><a href="http://www.designchemical.com/blog/" target="_blank" id="dcwp-avatar"></a><?php echo $title; ?></h2>
			  <div class="postbox-container" style="width:65%; margin-right: 10px;">
			    <div class="metabox-holder">
				  <div class="meta-box-sortables">
				    <div class="postbox">
					  <h3 class="hndle"><span><?php echo $subtitle; ?></span></h3>
					  <div class="inside">
					  
			<?php

		}

		function close_admin_page() {

		?>

		</div></div></div></div></div>

		<div class="postbox-container" style="width:30%;">
			<div class="metabox-holder">	
				<div class="meta-box-sortables">
					<?php
						$this->dcwp_premium();
						$this->likebox();
						$this->support_box();
						$this->latest_posts();
						$this->info_box();
					?>				
				</div>
			</div>
		</div>
	</div>

		<?php

		}
	}
}