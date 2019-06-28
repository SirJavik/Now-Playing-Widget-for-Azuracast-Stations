<?php
/**
 *  * Plugin Name: Now Playing Widget für Azuracast Stationen
 *  * Description: Zeigt in einem Widget an, was gerade auf der AzuraCast-Instanz gespielt wird.
 *  * Plugin URI: https://javik.net/azuracast-widget
 *  * Version: 1.2.0
 *  * Author: Javik
 *  * Author URI: https://javik.net
 *  * Text Domain: now-playing-widget-fuer-azuracast-stationen
 *  * Domain Path: /languages
 *   */

// The widget class
class Azuracast_Widget extends WP_Widget {

    // Main constructor
    public function __construct() {
        parent::__construct(
        'azuracast_nowplaying',
        __( 'Azuracast: Now Playing', 'now-playing-widget-fuer-azuracast-stationen' ),
        array(
            'customize_selective_refresh' => true,
        )
    );
    }

    // The widget form (for the backend )
    public function form( $instance ) {
        // Set widget defaults
        $defaults = array(
            'title'                 => '',
            'azuracast_instanz'     => 'https://example.com/azuracast',
            'webplayer_link'        => 'https://example.com/online',
            'own_player_link'       => 'https://example.com/online.m3u',
            'show_cover'            => '1',
            'show_track'            => '1',
            'show_artist'           => '1',
            'show_album'            => '0',
            'station_id'            => '1',
            'own_player_btn'        => '1',
            'webplayer_btn'         => '1'
        );
    
        // Parse current settings with defaults
        extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

        <?php // Widget Title ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

        <?php // Text Field ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'azuracast_instanz' ) ); ?>"><?php _e( 'Azuracast', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'azuracast_instanz' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'azuracast_instanz' ) ); ?>" type="text" value="<?php echo esc_attr( $azuracast_instanz ); ?>" />
        </p>
        
        <?php // Webplayer Link ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'own_player_link' ) ); ?>"><?php _e( 'Own player link', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'own_player_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'own_player_link' ) ); ?>" type="text" value="<?php echo esc_attr( $own_player_link ); ?>" />
        </p>
        
        <?php // Own Player Link ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'webplayer_link' ) ); ?>"><?php _e( 'Webplayer link', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'webplayer_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'webplayer_link' ) ); ?>" type="text" value="<?php echo esc_attr( $webplayer_link ); ?>" />
        </p>

        <?php // Station ID ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'station_id' ) ); ?>"><?php _e( 'Station ID', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'station_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'station_id' ) ); ?>" type="text" value="<?php echo esc_attr( $station_id ); ?>" />
        </p>

        <?php // Checkbox ?>
        <p>
            <?php // Show Cover ?>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_cover' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cover' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_cover ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_cover' ) ); ?>"><?php _e( 'Show cover', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
            <br>

            <?php // Show Track ?>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_track' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_track' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_track ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_track' ) ); ?>"><?php _e( 'Show track', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
            <br>

            <?php // Show Artist ?>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_artist' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_artist' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_artist ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_artist' ) ); ?>"><?php _e( 'Show artist', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
            <br>

            <?php // Show Album ?>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_album' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_album' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_album ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_album' ) ); ?>"><?php _e( 'Show album', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
            <br>
            
            <?php // Show Webplayer Button ?>
            <input id="<?php echo esc_attr( $this->get_field_id( 'webplayer_btn' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'webplayer_btn' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $webplayer_btn ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'webplayer_btn' ) ); ?>"><?php _e( 'Show webplayer button', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
            <br>
            
            <?php // Show Own Player Button ?>
            <input id="<?php echo esc_attr( $this->get_field_id( 'own_player_btn' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'own_player_btn' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $own_player_btn ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'own_player_btn' ) ); ?>"><?php _e( 'Show own player button', 'now-playing-widget-fuer-azuracast-stationen' ); ?></label>
        </p>
    <?php 
    }

    // Update widget settings
    public function update( $new_instance, $old_instance ) {
        
        $instance = $old_instance;
        $instance['title']                  = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
        $instance['azuracast_instanz']      = isset( $new_instance['azuracast_instanz'] ) ? wp_strip_all_tags( $new_instance['azuracast_instanz'] ) : '';
        
        $instance['own_player_link']        = isset( $new_instance['own_player_link'] ) ? wp_strip_all_tags( $new_instance['own_player_link'] ) : '';
        $instance['webplayer_link']         = isset( $new_instance['webplayer_link'] ) ? wp_strip_all_tags( $new_instance['webplayer_link'] ) : '';  
        $instance['station_id']             = isset( $new_instance['station_id'] ) ? wp_strip_all_tags( $new_instance['station_id'] ) : '';  

        $instance['show_cover']             = isset( $new_instance['show_cover'] ) ? 1 : false;
        $instance['show_track']             = isset( $new_instance['show_track'] ) ? 1 : false;
        $instance['show_artist']            = isset( $new_instance['show_artist'] ) ? 1 : false;
        $instance['show_album']             = isset( $new_instance['show_album'] ) ? 1 : false;   
        
        $instance['own_player_btn']         = isset( $new_instance['own_player_btn'] ) ? 1 : false;
        $instance['webplayer_btn']          = isset( $new_instance['webplayer_btn'] ) ? 1 : false;   

        return $instance;
    }

    // Display the widget
    public function widget( $args, $instance ) {
        extract( $args );

    // Check the widget options
    $title                  = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
    $azuracast_instanz      = isset( $instance['azuracast_instanz'] ) ? $instance['azuracast_instanz'] : '';
    $station_id             = isset( $instance['station_id'] ) ? $instance['station_id'] : '';     

    $show_cover             = ! empty( $instance['show_cover'] ) ? $instance['show_cover'] : false;
    $show_track             = ! empty( $instance['show_track'] ) ? $instance['show_track'] : false;
    $show_artist            = ! empty( $instance['show_artist'] ) ? $instance['show_artist'] : false;
    $show_album             = ! empty( $instance['show_album'] ) ? $instance['show_album'] : false;
    
    $own_player_btn         = ! empty( $instance['own_player_btn'] ) ? $instance['own_player_btn'] : false;
    $webplayer_btn          = ! empty( $instance['webplayer_btn'] ) ? $instance['webplayer_btn'] : false;
    
    $own_player_link        = ! empty( $instance['own_player_link'] ) ? $instance['own_player_link'] : false;
    $webplayer_link         = ! empty( $instance['webplayer_link  '] ) ? $instance['webplayer_link  '] : false;


    // WordPress core before_widget hook (always include )
    echo $before_widget;

   // Display the widget
   echo '<div class="acnp">';

        // Display widget title if defined
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        if ( $azuracast_instanz ) { 
            $nowplaying = $azuracast_instanz . "/api/nowplaying/" . $station_id;

            $response   = wp_remote_get($nowplaying, array( 'timeout' => 120, 'httpversion' => '2.0' ) );
            $body       = wp_remote_retrieve_body($response);

            $data = json_decode($body, true);
            
            $current_artist = $data['now_playing']['song']['artist'];
            $current_song   = $data['now_playing']['song']['title'];
            $current_album  = $data['now_playing']['song']['album'];
            $current_cover  = $data['now_playing']['song']['art'];
            
            if($show_cover != false) {
                echo '<div class="acnp_cover">';
                echo '<img src="'.$current_cover.'" alt="'.$current_artist.' - '.$current_song.'">';
                echo '</div>';
            }  
            ?>
        
                <div class="acnp_text">
                    <div class="acnp_prefix">
                        <?php _e( 'Now playing:', 'now-playing-widget-fuer-azuracast-stationen' );?>
                    </div>
                    
                <div class="acnp_title">
                    <?php
                    if($show_artist == true && $show_track == true) {
                        echo '<span id="acnp_api_artist">'.$current_artist.'</span> - <span id="acnp_api_title">'.$current_song.'</span>';
                    } elseif($show_artist == false && $show_track == true) {
                        echo '<span id="acnp_api_title">'.$current_song.'</span>';
                    } elseif($show_artist == true && $show_track == false) {
                        echo '<span id="acnp_api_artist">'.$current_artist.'</span>';
                    }
                    
                    if($show_album == true) {
                        echo '<br>';
                        echo '<span id="acnp_api_album">'.$current_album.'</span>';
                    }
                    ?>
                </div>
                    
                <div class="acnp_cta" id="inline">
                    <?php
                    if($webplayer_btn == true) {
                        echo '<input type="button" value="'.__( 'Webplayer', 'now-playing-widget-fuer-azuracast-stationen' ).'" onclick="window.open(\''.$webplayer_link.'\');" />';
                    }
                    if($own_player_btn == true) {
                        echo '<input type="button" value="'.__( 'Eigener Player', 'now-playing-widget-fuer-azuracast-stationen' ).'"  onclick="window.open(\''.$own_player_link.'\');" />';
                    }
                    ?>
                </div>
            </div>

            </div>

            <div class="acnp_cta" id="outline">
		        <?php
		        if($webplayer_btn == true) {
			        echo '<input type="button" value="'.__( 'Webplayer', 'now-playing-widget-fuer-azuracast-stationen' ).'" onclick="window.open(\''.$webplayer_link.'\');" />';
		        }
		        if($own_player_btn == true) {
			        echo '<input type="button" value="'.__( 'Own player', 'now-playing-widget-fuer-azuracast-stationen' ).'"  onclick="window.open(\''.$own_player_link.'\');" />';
		        }
		        ?>
            </div>



            <?php
        }


    // WordPress core after_widget hook (always include )
    echo $after_widget;
    }

}

// Register the widget
function azurawidget_register_custom_widget() {
    register_widget( 'Azuracast_Widget' );
}
add_action( 'widgets_init', 'azurawidget_register_custom_widget' );

// Styling
add_action('wp_enqueue_scripts', 'azurawidget_register_styles');
function azurawidget_register_styles() {
    wp_register_style( 'azurawidget_stlye', plugin_dir_url( __FILE__ )."css/azuracast-widget.css" );
    wp_enqueue_style( 'azurawidget_stlye' );
}

function azurawidget_load_plugin_textdomain() {
    load_plugin_textdomain( 'now-playing-widget-fuer-azuracast-stationen', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'azurawidget_load_plugin_textdomain' );
