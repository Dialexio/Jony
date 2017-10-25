<?php
/**
 * SkinTemplate class for the Jony skin
 *
 * @ingroup Skins
 */
class SkinJony extends SkinTemplate {
	public $skinname = 'jony', $stylename = 'Jony',
		$template = 'JonyTemplate', $useHeadElement = true;

	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param $out OutputPage
	 */
	public function initPage( OutputPage $out ) {

		$out->addMeta( 'viewport', 'width=device-width, min-width=800, initial-scale=0.5');

		$out->addModuleStyles( array(
			'mediawiki.skinning.interface',
			'mediawiki.skinning.content.externallinks',
			'skins.jony'
		) );
/*		$out->addModules( array(
			'skins.jony.js'
		) );*/
	}

	/**
	 * @param $out OutputPage
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
	}
}
