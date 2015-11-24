<?php
class nest_Social {
	private $social_networks = array();
	
	public function __construct() {
		
	}
	
	private function init() {
		$this->social_networks = array(
		'bitbucket.org'      => array( 'name' => 'Bitbucket',      'class' => 'bitbucket',     'icon' => 'fa-bitbucket',     'icon-sign' => 'fa-bitbucket-sign'   ),
		'dribbble.com'       => array( 'name' => 'Dribbble',       'class' => 'dribbble',      'icon' => 'fa-dribbble',      'icon-sign' => 'fa-dribbble'         ),
		'dropbox.com'        => array( 'name' => 'Dropbox',        'class' => 'dropbox',       'icon' => 'fa-dropbox',       'icon-sign' => 'fa-dropbox'          ),
		'facebook.com'       => array( 'name' => 'Facebook',       'class' => 'facebook',      'icon' => 'fa-facebook',      'icon-sign' => 'fa-facebook-sign'    ),
		'flickr.com'         => array( 'name' => 'Flickr',         'class' => 'flickr',        'icon' => 'fa-flickr',        'icon-sign' => 'fa-flickr'           ),
		'foursquare.com'     => array( 'name' => 'Foursquare',     'class' => 'foursquare',    'icon' => 'fa-foursquare',    'icon-sign' => 'fa-foursquare'       ),
		'github.com'         => array( 'name' => 'Github',         'class' => 'github',        'icon' => 'fa-github',        'icon-sign' => 'fa-github-sign'      ),
		'gittip.com'         => array( 'name' => 'GitTip',         'class' => 'gittip',        'icon' => 'fa-gittip',        'icon-sign' => 'fa-gittip'           ),
		'instagr.am'         => array( 'name' => 'Instagram',      'class' => 'instagram',     'icon' => 'fa-instagram',     'icon-sign' => 'fa-instagram'        ),
		'instagram.com'      => array( 'name' => 'Instagram',      'class' => 'instagram',     'icon' => 'fa-instagram',     'icon-sign' => 'fa-instagram'        ),
		'linkedin.com'       => array( 'name' => 'LinkedIn',       'class' => 'linkedin',      'icon' => 'fa-linkedin',      'icon-sign' => 'fa-linkedin-sign'    ),
		'mailto:'            => array( 'name' => 'Email',          'class' => 'envelope',      'icon' => 'fa-envelope',      'icon-sign' => 'fa-envelope-alt'     ),
		'pinterest.com'      => array( 'name' => 'Pinterest',      'class' => 'pinterest',     'icon' => 'fa-pinterest',     'icon-sign' => 'fa-pinterest-sign'   ),
		'plus.google.com'    => array( 'name' => 'Google+',        'class' => 'google-plus',   'icon' => 'fa-google-plus',   'icon-sign' => 'fa-google-plus-sign' ),
		'renren.com'         => array( 'name' => 'RenRen',         'class' => 'renren',        'icon' => 'fa-renren',        'icon-sign' => 'fa-renren'           ),
		'stackoverflow.com'  => array( 'name' => 'Stack Exchange', 'class' => 'stackexchange', 'icon' => 'fa-stackexchange', 'icon-sign' => 'fa-stackexchange'    ),
		'trello.com'         => array( 'name' => 'Trello',         'class' => 'trello',        'icon' => 'fa-trello',        'icon-sign' => 'fa-trello'           ),
		'tumblr.com'         => array( 'name' => 'Tumblr',         'class' => 'tumblr',        'icon' => 'fa-tumblr',        'icon-sign' => 'fa-tumblr'           ),
		'twitter.com'        => array( 'name' => 'Twitter',        'class' => 'twitter',       'icon' => 'fa-twitter',       'icon-sign' => 'fa-twitter-sign'     ),
		'vk.com'             => array( 'name' => 'VK',             'class' => 'vk',            'icon' => 'fa-vk',            'icon-sign' => 'fa-vk'               ),
		'weibo.com'          => array( 'name' => 'Weibo',          'class' => 'weibo',         'icon' => 'fa-weibo',         'icon-sign' => 'fa-weibo'            ),
		'xing.com'           => array( 'name' => 'Xing',           'class' => 'xing',          'icon' => 'fa-xing',          'icon-sign' => 'fa-xing'             ),
		'youtu.be'           => array( 'name' => 'YouTube',        'class' => 'youtube',       'icon' => 'fa-youtube',       'icon-sign' => 'fa-youtube-sign'     ),
		'youtube.com'        => array( 'name' => 'YouTube',        'class' => 'youtube',       'icon' => 'fa-youtube',       'icon-sign' => 'fa-youtube-sign'     ) );
	}
	//Takes an array of url strings
	//Return HTML list items
	public function get_icons( $urls = array() ) {
		if ( empty( $this->social_networks ) ) {
			$this->init();
		}
		if ( empty( $urls ) || !is_array( $urls ) ) {
			return '';
		}
		$html = '<ul id="social-wrap">';
		foreach( $urls as $url ) {
			foreach( $this->social_networks as $domain => $args ) {
				if ( false !== strpos( $url, $domain ) ) { 
					$html .= sprintf( '<li><a href="%1$s" target="_blank"><i class="fa fa-%2$s fa-fw"></i><span class="fa-content">&nbsp;%3$s</span></a></li>',esc_url( $url ), esc_attr( $args[ 'class' ] ), esc_html( $args[ 'name' ] ) );
				}
			}
		}
		$html .= '</ul>';
		return $html;
	}
}
function nest_get_social( $echo = true ) {
    $locations = get_nav_menu_locations();
    $urls = array();
    if ( isset( $locations[ 'social-nav' ] ) ) {
        $menu = wp_get_nav_menu_object( $locations[ 'social-nav' ] );
        if( $menu ) {
            $menu_items = wp_get_nav_menu_items( $menu->term_id );
            foreach( $menu_items as $index => $menu_item ) {
                $urls[] = $menu_item->url;
            }
        }
    }
    $social_html = '';
    if ( !empty( $urls ) ) {
        $social = new nest_Social();
        $social_html = $social->get_icons( $urls );
    }
    if ( $echo ) {
        echo $social_html;
    } else {
        return $social_html;
    }
}