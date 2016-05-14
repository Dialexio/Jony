<?php
/**
 * Skin file for the Jony skin.
 *
 * @file
 * @ingroup Skins
 */

/**
 * SkinTemplate class for the Jony skin
 *
 * @ingroup Skins
 */
class SkinJony extends SkinTemplate {
	public $skinname = 'jony', $stylename = 'Jony',
		$template = 'JonyTemplate', $useHeadElement = true;

/*
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$out->addModules( 'skins.jony.js' );
	}
*/

	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param $out OutputPage
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( array(
			'mediawiki.skinning.interface', 'skins.jony'
		) );
	}
}

/**
 * BaseTemplate class for the Jony skin
 *
 * @ingroup Skins
 */
class JonyTemplate extends BaseTemplate {
	/**
	 * Outputs a single sidebar portlet of any kind.
	 */
	private function outputPortlet( $box ) {
		if ( !$box['content'] ) {
			return;
		}

		?>
		<?php if($box['id'] == "p-actions") echo "<div id=\"more\"></div>"; ?>
		<div
			role="navigation"
			class="mw-portlet"
			id="<?php echo Sanitizer::escapeId( $box['id'] ) ?>"
			<?php echo Linker::tooltip( $box['id'] ) ?>
		>
			<h3>
				<?php
				if ( isset( $box['headerMessage'] ) ) {
					$this->msg( $box['headerMessage'] );
				} else {
					echo htmlspecialchars( $box['header'] );
				}
				?>
			</h3>

			<?php
			if ( is_array( $box['content'] ) ) {
				echo '<ul>';
				foreach ( $box['content'] as $key => $item ) {
					echo $this->makeListItem( $key, $item );
				}
				echo '</ul>';
			} else {
				echo $box['content'];
			}?>
		</div>
		<?php
	}

	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$this->html( 'headelement' ) ?>

	<?php if ( $this->data['newtalk'] ) { ?>
		<div id="usermessage" onclick="$(this).slideUp(100);">
			<h4><?php $this->html( 'newtalk' ) ?></h4>
			<p>Clicking this alert will hide it until the next page loads. You must view the message to permanently clear this.</p>
		</div>
	<?php } ?>

		<div id="mw-wrapper">
			<div id="p-logo">
				<a href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] ) ?>"
					<?php echo Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( 'p-logo' ) ) ?>
				>
					<img
						src="<?php $this->text( 'logopath' ) ?>"
						alt="<?php $this->text( 'sitename' ) ?>"
					/>
				</a>
			</div>


			<div id="mw-panel">
				<?php
				foreach ( $this->getSidebar() as $boxName => $box ) {
					$this->outputPortlet( $box );
				}
				?>
			</div>


			<div id="mw-toolbar">
				<div id="mw-status" ondblclick="$('html, body').animate({ scrollTop: 0 }, 'fast');">
					<?php

					$this->outputPortlet( array(
						'id' => 'p-personal',
						'headerMessage' => 'personaltools',
						'content' => $this->getPersonalTools(),
					) );
					?>
				</div>

				<div id="mw-tabs">
					<?php

					$this->outputPortlet( array(
						'id' => 'p-namespaces',
						'headerMessage' => 'namespaces',
						'content' => $this->data['content_navigation']['namespaces'],
					) );
					$this->outputPortlet( array(
						'id' => 'p-variants',
						'headerMessage' => 'variants',
						'content' => $this->data['content_navigation']['variants'],
					) );
					$this->outputPortlet( array(
						'id' => 'p-views',
						'headerMessage' => 'views',
						'content' => $this->data['content_navigation']['views'],
					) );
					$this->outputPortlet( array(
						'id' => 'p-actions',
						'headerMessage' => 'actions',
						'content' => $this->data['content_navigation']['actions'],
					) );
					?>
					<form
						action="<?php $this->text( 'wgScript' ) ?>"
						class="mw-portlet"
						id="p-search">
							<input type="hidden" name="title" value="<?php $this->text( 'searchtitle' ) ?>" />

							<h3><label for="searchInput"><?php $this->msg( 'search' ) ?></label></h3>

							<?php echo $this->makeSearchInput( array( "id" => "searchInput" ) ) ?>
							<?php echo $this->makeSearchButton( 'go' ) ?>
					</form>
				</div>
			</div>

			<div id="mw-toolbar-spacer">
			</div>

			<div class="mw-body">
				<?php if ( $this->data['sitenotice'] ) { ?>
					<div id="siteNotice"><?php $this->html( 'sitenotice' ) ?></div>
				<?php } ?>

				<h1 class="firstHeading">
					<?php $this->html( 'title' ) ?>
				</h1>

				<div id="siteSub"><?php $this->msg( 'tagline' ) ?></div>

				<div class="mw-body-content">
					<div id="contentSub">
						<?php if ( $this->data['subtitle'] ) { ?>
							<p><?php $this->html( 'subtitle' ) ?></p>
						<?php } ?>
						<?php if ( $this->data['undelete'] ) { ?>
							<p><?php $this->html( 'undelete' ) ?></p>
						<?php } ?>
					</div>

					<?php $this->html( 'bodytext' ) ?>

					<?php $this->html( 'catlinks' ) ?>

					<?php $this->html( 'dataAfterContent' ); ?>

				</div>
			</div>

			<div id="mw-footer">
				<ul id="contentinfo">
					<?php foreach ( $this->getFooterIcons( 'icononly' ) as $blockName => $footerIcons ) { ?>
						<li>
							<?php
							foreach ( $footerIcons as $icon ) {
								echo $this->getSkin()->makeFooterIcon( $icon );
							}
							?>
						</li>
					<?php } ?>
				</ul>

				<?php foreach ( $this->getFooterLinks() as $category => $links ) { ?>
					<ul class="footer-privacy">
						<?php foreach ( $links as $key ) { ?>
							<li><?php $this->html( $key ) ?></li>
						<?php } ?>
					</ul>
				<?php } ?>
			</div>
		</div>

		<?php $this->printTrail() ?>
		</body></html>

		<?php
	}
}
