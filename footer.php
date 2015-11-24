<footer class="footer content-wrapper" role="contentinfo">
	<div itemscope itemtype="http://schema.org/LocalBusiness">
    	<?php
        	$address = get_option( 'nest_street' );
        	$city = get_option( 'nest_city' );
        	$state = get_option( 'nest_state' );
        	$zip = get_option( 'nest_zip' );
        	$phone = get_option( 'nest_phone' );
        	$fax = get_option( 'nest_fax' );
        	$email = get_option( 'nest_email' );
        	?>
        	
		<span itemprop="name"><?php nest_copyright( '2015', $echo = true ); ?> <?php echo esc_html( get_bloginfo('name') ); ?></span><br />
        <?php if( $address ){
          echo '<span itemprop="streetAddress">' . esc_html( $address ) . '</span><br />';
        } ?>
        <?php if( $city ){
          echo '<span itemprop="addressLocality">' . esc_html( $city ) . '</span>, ';
        } ?>
        <?php if( $state ){
          echo '<span itemprop="addressRegion">' . esc_html( $state ) . '</span>';
        } ?>
        <?php if( $zip ){
          echo '<span itemprop="postalcode">' . esc_html( $zip ) . '</span><br />';
        } ?>
        <?php if( $address ){
          echo '<a href="https://maps.google.com?q=' . esc_html( $address ) . '+' . esc_html( $city ) . '+' . esc_html( $state ) . '+' . esc_html( $zip ) . '" target="_blank">Google Map</a>';
        } ?>
        <?php if( $phone ){
          echo '<br /><span itemprop="telephone">' . esc_html( $phone ) . '</span>';
        } ?>
        <?php if( $email ){
          echo '<br /><a itemprop="email"' . 'href="mailto:' . esc_html( antispambot( $email ) ) .'">' . esc_html( antispambot( $email ) ) . '</a>'; 
        } ?>
    </div><!--schema-->
	<?php wp_nav_menu( array('theme_location' => 'footer-nav' )); ?><!--footer--menu-->
</footer><!--footer-->
<?php wp_footer(); ?>
<?php
/* Use Google Analytics Plugin for Google Analytics: https://wordpress.org/plugins/google-analytics-for-wordpress/
*/
?>
</body>
</html>