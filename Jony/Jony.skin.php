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

		$out->addModuleStyles( array(
			'mediawiki.skinning.interface',
			'mediawiki.skinning.content.externallinks',
			'skins.jony'
		) );
/*		$out->addModules( array(
			'skins.jony.js'
		) );*/
	}
}
