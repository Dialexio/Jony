<?php
/**
 * Jony skin
 *
 * @file
 * @ingroup Skins
 * @author Dialexio (https://github.com/Dialexio)
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License 2.0
 */

 if (function_exists('wfLoadSkin')) {
	 wfLoadSkin( 'Jony' );
}

else {
	if ( !defined( 'MEDIAWIKI' ) ) {
		die( 'This is an extension to the MediaWiki package and cannot be run standalone.' );
	}

	$wgExtensionCredits['skin'][] = array(
		'path' => __FILE__,
		'name' => 'Jony', // name as shown under [[Special:Version]]
		'namemsg' => 'skinname-jony',
		'version' => '1.0.5',
		'url' => 'https://github.com/Dialexio/Jony',
		'author' => '[https://github.com/Dialexio Dialexio]',
		'descriptionmsg' => 'jony-desc',
		'license-name' => 'GPL-2.0+',
	);

	$wgValidSkinNames['jony'] = 'Jony';
	$wgAutoloadClasses['SkinJony'] = __DIR__ . '/Jony.skin.php';
	$wgMessagesDirs['Jony'] = __DIR__ . '/i18n';

	$wgResourceModules['skins.jony'] = array(
		'styles' => array(
			'Jony/resources/print.less' => array( 'media' => 'print' ),
			'Jony/resources/screen.less' => array( 'media' => 'screen' ),
		),
		'remoteBasePath' => &$GLOBALS['wgStylePath'],
		'localBasePath' => &$GLOBALS['wgStyleDirectory'],
	);

	/*
	//Only add a module for 'scripts' if your skin actually needs custom JavaScript
	$wgResourceModules['skins.jony.js'] = array(
		'scripts' => array(
			'Jony/resources/cool.js',
			'Jony/resources/awesome.js',
		),
		'dependencies' => array(
			// In this example, awesome.js needs the jQuery UI dialog stuff
			'jquery.ui.dialog',
		),
		'remoteBasePath' => &$GLOBALS['wgStylePath'],
		'localBasePath' => &$GLOBALS['wgStyleDirectory'],
	);
	*/
}
