<?php
namespace Chisel;

/**
 * Class Site
 * @package Chisel
 *
 * Use this class to setup whole site related configuration
 */
class Site extends \Timber\Site {

	private $templatesDir = 'templates';

	/**
	 * Site constructor.
	 */
	public function __construct() {

		\Timber\Timber::$dirname = $this->templatesDir;

		$this->chiselInit();

		parent::__construct();
	}

	/**
	 * Initiate Chisel configuration.
	 */
	public function chiselInit() {
		add_filter( 'timber_context', array( $this, 'addToContext' ) );
		add_filter( 'get_twig', array( '\Chisel\TwigExtensions', 'extend' ) );
		add_filter( 'Timber\PostClassMap', array( '\Chisel\Post', 'overrideTimberPostClass' ) );
	}

	/**
	 * You can add custom global data to twig context
	 *
	 * @param array $context
	 *
	 * @return array
	 */
	public static function addToContext( $context ) {
		$context['main_nav'] = new \Timber\Menu();
		$context['post']     = new \Chisel\Post();

		return $context;
	}
}
