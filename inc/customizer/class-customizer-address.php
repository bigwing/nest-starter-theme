<?php
add_action( 'customize_register', function( $wp_customize ) {
    class Nest_Address_Customizer_Control extends WP_Customize_Control {
        public $type = 'text';
        public function render_content() {
            ?>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input type="text" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
            </label>
            <?php
        }
    }
}  );
