<?php


namespace javik\azuracast_plugin;


class Azuracast_Shortcode {

	public function Shortcode( $atts = [], $tag = '' ) {
		// normalize attribute keys, lowercase
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

		$current_cover = "https://revy.javik.net:8443/static/img/generic_song.jpg";
		$current_artist = "Awesome Artist";
		$current_song = "Awesome Song";
		$current_album = "Awesome Album";
		$webplayer_link = "https://example.com/webplayer";
		$own_player_link = "https://example.com/playlist.pls";

		// override default attributes with user attributes
		$default_atts = shortcode_atts([
			'title' => 'Now playing:',
			'showcover' => "true",
			"showartist" => "true",
			"showtrack" => "true",
			"showalbum" => "false",
			"showwebplayerbutton" => "true",
			"ownplayerbutton" => "true",
		], $atts, $tag);

		// start output
		$o = '';

		// Start Box
		$o .= '<div class="acnp">';


		// Cover
		if ( $default_atts["showcover"] == "true" ) {
			$o .= '<div class="acnp_cover">';
			$o .= '<img id="acnp_api_img" src="' . $current_cover . '" alt="' . $current_artist . ' - ' . $current_song . '">';
			$o .= '</div>';
		}
		// End Cover

		// Inner Box
		$o .= '<div class="acnp_text">';

		// Title
		$o .= '<div class="acnp_prefix">';
		$o .= esc_html__($default_atts['title'], 'now-playing-widget-fuer-azuracast-stationen');
		$o .= '</div>';
		// End Title

		// Artist & Track
		if ( $default_atts["showartist"] == "true" && $default_atts["showtrack"] == "true" ) {
			$o .=  '<span id="acnp_api_artist">' . $current_artist . '</span> - <span id="acnp_api_title">' . $current_song . '</span>';
		} elseif ( $default_atts["showartist"] == "false" && $default_atts["showtrack"] == "true" ) {
			$o .=  '<span id="acnp_api_title">' . $current_song . '</span>';
		} elseif ( $default_atts["showartist"] == "true" && $default_atts["showtrack"] == "false" ) {
			$o .=  '<span id="acnp_api_artist">' . $current_artist . '</span>';
		}
		// End Artist

		// Album
		if ( $default_atts["showartist"] == "true" ) {
			$o .= '<br>';
			$o .= '<span id="acnp_api_album">' . $current_album . '</span>';
		}
		// End Album

		// Buttons
		$o .= '<div class="acnp_cta" id="inline">';
		if ( $default_atts["showwebplayerbutton"] == "true" ) {
			$o .= '<input type="button" value="' . __( 'Webplayer', 'now-playing-widget-fuer-azuracast-stationen' ) . '" onclick="window.open(\'' . $webplayer_link . '\');" />';
		}
		if ( $default_atts["ownplayerbutton"] == "true" ) {
			$o .= '<input type="button" value="' . __( 'Own player', 'now-playing-widget-fuer-azuracast-stationen' ) . '"  onclick="window.open(\'' . $own_player_link . '\');" />';
		}
		$o .= '</div>';
		// End Buttons

		// End Inner Box
		$o .= '</div>';

		// End Box
		$o .= '</div>';

		// return output
		return $o;
	}

	public static function InitShortcode() {

		$shortcode = new Azuracast_Shortcode();
		add_shortcode('azuracast', array($shortcode, 'Shortcode'));
	}
}