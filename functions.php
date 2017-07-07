<?php
spl_autoload_register( function ( $class ) {

	$baseDirectory = __DIR__ . '/Chisel/';
	$chiselNamespace = 'Chisel\\';

	$namespacePrefixLength = strlen( $chiselNamespace );

	if ( strncmp( $chiselNamespace, $class, $namespacePrefixLength ) !== 0 ) {
		return;
	}

	$relativeClassName = substr( $class, $namespacePrefixLength );

	$classFilename = $baseDirectory . str_replace( '\\', '/', $relativeClassName ) . '.php';

	if ( file_exists( $classFilename ) ) {
		require $classFilename;
	}
} );

new \Chisel\Security();
new \Chisel\WpExtensions();

\Chisel\Helpers::setChiselEnv();

// Activate Timber Site
if ( \Chisel\Helpers::isTimberActivated() ) {
	new \Chisel\Site();
} else {
	\Chisel\Helpers::addTimberAdminNotice();
	return;
}

