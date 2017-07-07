<?php
namespace Chisel;

/**
 * Helpers Security
 * @package Chisel
 */
class Helpers {

	public static function isTimberActivated() {
		if ( class_exists( 'Timber\\Timber' ) ) {
			return true;
		} else {
			return false;
		}
	}

	public static function addTimberAdminNotice() {
		add_action( 'admin_notices',
			function () {
				echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
			}
		);
	}

	public static function setChiselEnv() {
		if ( isset( $_SERVER['HTTP_X_CHISEL_PROXY'] ) ) {
			define( 'CHISEL_DEV_ENV', true );
		}
	}
}
