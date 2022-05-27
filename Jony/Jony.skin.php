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
	 * @inheritDoc
	 */
	public function __construct( $options ) {
		$options['bodyOnly'] = true;
		parent::__construct( $options );
	}

	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param $out OutputPage
	 */
	public function initPage( OutputPage $out ) {
		if ( version_compare( MW_VERSION, '1.36', '<' ) ) {
			$out->addModuleStyles( [
				'mediawiki.skinning.interface',
				'mediawiki.skinning.content.externallinks',
				'skins.jony'
			] );
		} else {
			$out->addModuleStyles( [
				'skins.jony.styles'
			] );
		}
	}
}
