<?php


namespace javik\aazuracast_plugin;


class Azuracast_Gutenberg {
	public static function register_block() {
		// automatically load dependencies and version
		/*$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

		wp_register_script(
			'gutenberg-examples-01-esnext',
			plugins_url( 'build/block.js', __FILE__ ),
			$asset_file['dependencies'],
			$asset_file['version']
		);

		register_block_type( 'gutenberg-examples/example-01-basic-esnext', array(
			'editor_script' => 'gutenberg-examples-01-esnext',
		) );*/
	}
}

