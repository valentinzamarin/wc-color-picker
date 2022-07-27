<?php
/**
 * Plugin Name: WooCommerce Color Picker
 */

 class WC_Color_Picker { 
    public function __construct() {
        $this->plugin_name = 'WC_Color_Picker';
		$this->version = '1.0.0';

        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
        add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [ $this, 'override_color_variation_display' ], 10, 2 );
    }
    public function override_color_variation_display( $html, $args ) {
        $options = $args['options'];
        
        $attribute = $args['attribute'];
        
        if( $attribute === 'color' ) {
            $html .= '<div class="wcp">';
            foreach( $options as $option ) {
                $html .= '<a href="#" class="wcp__item wcp-js" data-value="' . $option . '" style="background:' . $option . '" ></a>';
            }
            $html .= '</div>';
            
            
        }
        return $html;
    }

    public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-styles.css', array(), $this->version, 'all' );

	}

    public function enqueue_scripts() {

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-scripts.js', array( 'jquery' ), $this->version, false );
        wp_localize_script(  $this->plugin_name , 'wcp', array(
            'nonce'    => wp_create_nonce( 'wcp' ),
            'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
    
    
    }
 }

 new WC_Color_Picker();