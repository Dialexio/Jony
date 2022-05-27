<?php
/**
 * BaseTemplate class for the Jony skin
 *
 * @ingroup Skins
 */
class JonyTemplate extends BaseTemplate {
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		if ( version_compare( MW_VERSION, '1.39', '<' ) ) {
			$this->html( 'headelement' );
		}
		?>
		<div id="mw-wrapper">
			<?php
			echo Html::rawElement(
				'h2',
				[],
				$this->getMsg( 'navigation-heading' )->parse()
			);

			echo $this->getLogo();

			// Site navigation/sidebar
			echo Html::rawElement(
				'div',
				[ 'id' => 'mw-panel' ],
				$this->getSiteNavigation()
			);
			?>

			<div id="mw-toolbar">
				<?php 
				// User profile links
				echo Html::rawElement(
					'div',
					[ 'id' => 'user-tools' ],
					$this->getUserLinks()
				);
				?>

				<div id="mw-tabs">
					<?php
					// Page editing and tools
					echo Html::rawElement(
						'div',
						[ 'id' => 'page-tools' ],
						$this->getPageLinks()
					);

					// Search box
					echo $this->getSearch();
					?>
				</div>
			</div>

			<div id="mw-toolbar-spacer"></div>

			<div class="mw-body" role="main">
				<?php
				if ( $this->data['sitenotice'] ) {
					echo Html::rawElement(
						'div',
						[ 'id' => 'siteNotice' ],
						$this->get( 'sitenotice' )
					);
				}
				if ( $this->data['newtalk'] ) {
					echo Html::rawElement(
						'div',
						[ 'class' => 'usermessage' ],
						$this->get( 'newtalk' )
					);
				}
				echo $this->getIndicators();
				echo Html::rawElement(
					'h1',
					[
						'class' => 'firstHeading',
						'lang' => $this->get( 'pageLanguage' )
					],
					$this->get( 'title' )
				);

				echo Html::rawElement(
					'div',
					[ 'id' => 'siteSub' ],
					$this->getMsg( 'tagline' )->parse()
				);
				?>

				<div class="mw-body-content">
					<?php
					echo Html::openElement(
						'div',
						[ 'id' => 'contentSub' ]
					);
					if ( $this->data['subtitle'] ) {
						echo Html::rawelement (
							'p',
							[],
							$this->get( 'subtitle' )
						);
					}
					echo Html::rawelement (
						'p',
						[],
						$this->get( 'undelete' )
					);
					echo Html::closeElement( 'div' );

					$this->html( 'bodycontent' );
					$this->clear();
					echo Html::rawElement(
						'div',
						[ 'class' => 'printfooter' ],
						$this->get( 'printfooter' )
					);
					$this->html( 'catlinks' );
					$this->html( 'dataAfterContent' );
					?>
				</div>
			</div>

			<div id="mw-footer">
				<?php
				echo Html::openElement(
					'ul',
					[
						'id' => 'footer-icons',
						'role' => 'contentinfo'
					]
				);
				$footerIconsData = $this->get('footericons');
				foreach ( $footerIconsData as $blockName => $footerIcons ) {
					echo Html::openElement(
						'li',
						[
							'id' => 'footer-' . Sanitizer::escapeIdForAttribute( $blockName ) . 'ico'
						]
					);
					foreach ( $footerIcons as $icon ) {
						echo $this->getSkin()->makeFooterIcon( $icon );
					}
					echo Html::closeElement( 'li' );
				}
				echo Html::closeElement( 'ul' );

				foreach ( $this->getFooterLinks() as $category => $links ) {
					echo Html::openElement(
						'ul',
						[
							'id' => 'footer-' . Sanitizer::escapeIdForAttribute( $category ),
							'role' => 'contentinfo'
						]
					);
					foreach ( $links as $key ) {
						echo Html::rawElement(
							'li',
							[
								'id' => 'footer-' . Sanitizer::escapeIdForAttribute( $category . '-' . $key )
							],
							$this->get( $key )
						);
					}
					echo Html::closeElement( 'ul' );
				}
				$this->clear();
				?>
			</div>
		</div>

		<?php 
		if ( version_compare( MW_VERSION, '1.39', '<' ) ) {
			$this->printTrail();
			echo '</body></html>';
		}
	}

	/**
	 * Generates a single sidebar portlet of any kind
	 *
	 * @param array $box
	 * @return string html
	 */
	private function getPortlet( $box ) {
		if ( !$box['content'] ) {
			return;
		}

		$html = Html::openElement(
			'div',
			[
				'role' => 'navigation',
				'class' => 'mw-portlet',
				'id' => Sanitizer::escapeIdForAttribute( $box['id'] )
			] + Linker::tooltipAndAccesskeyAttribs( $box['id'] )
		);
		$html .= Html::element(
			'h3',
			[],
			isset( $box['headerMessage'] ) ? $this->getMsg( $box['headerMessage'] )->text() : $box['header'] );
		if ( is_array( $box['content'] ) ) {
			$html .= Html::openElement( 'ul' );
			foreach ( $box['content'] as $key => $item ) {
				$html .= $this->makeListItem( $key, $item );
			}
			$html .= Html::closeElement( 'ul' );
		} else {
			$html .= $box['content'];
		}
		$html .= Html::closeElement( 'div' );

		return $html;
	}

	/**
	 * Generates the logo and (optionally) site title
	 * @return string html
	 */
	private function getLogo( $id = 'p-logo', $imageOnly = false ) {
		$html = Html::openElement(
			'div',
			[
				'id' => $id,
				'class' => 'mw-portlet',
				'role' => 'banner'
			]
		);
		$html .= Html::element(
			'a',
			[
				'href' => $this->data['nav_urls']['mainpage']['href'],
				'class' => 'mw-wiki-logo',
			] + Linker::tooltipAndAccesskeyAttribs( 'p-logo' )
		);
		if ( !$imageOnly ) {
			$html .= Html::element(
				'a',
				[
					'id' => 'p-banner',
					'class' => 'mw-wiki-title',
					'href'=> $this->data['nav_urls']['mainpage']['href']
				] + Linker::tooltipAndAccesskeyAttribs( 'p-logo' ),
				$this->getMsg( 'sitetitle' )->escaped()
			);
		}
		$html .= Html::closeElement( 'div' );

		return $html;
	}

	/**
	 * Generates the search form
	 * @return string html
	 */
	private function getSearch() {
		$html = Html::openElement(
			'form',
			[
				'action' => htmlspecialchars( $this->get( 'wgScript' ) ),
				'role' => 'search',
				'class' => 'mw-portlet',
				'id' => 'p-search'
			]
		);
		$html .= Html::hidden( 'title', htmlspecialchars( $this->get( 'searchtitle' ) ) );
		$html .= Html::rawelement(
			'h3',
			[],
			Html::label( $this->getMsg( 'search' )->escaped(), 'searchInput' )
		);
		$html .= $this->makeSearchInput( [ 'id' => 'searchInput' ] );
		$html .= $this->makeSearchButton( 'go', [ 'id' => 'searchGoButton', 'class' => 'searchButton' ] );
		$html .= Html::closeElement( 'form' );

		return $html;
	}

	/**
	 * Generates the sidebar
	 * Set the elements to true to allow them to be part of the sidebar
	 * @return string html
	 */
	private function getSiteNavigation() {
		$html = '';

		$sidebar = $this->getSidebar();

		$sidebar['SEARCH'] = false;
		$sidebar['LANGUAGES'] = false;

		foreach ( $sidebar as $boxName => $box ) {
			if ( $boxName === false ) {
				continue;
			}
			if ( !is_bool( $box ) ) {
				$html .= $this->getPortlet( $box, true );
			}
		}

		return $html;
	}

	/**
	 * Generates page-related tools/links
	 * @return string html
	 */
	private function getPageLinks() {
		$html = $this->getPortlet( [
			'id' => 'p-namespaces',
			'headerMessage' => 'namespaces',
			'content' => $this->data['content_navigation']['namespaces'],
		] );
		$html .= $this->getPortlet( [
			'id' => 'p-variants',
			'headerMessage' => 'variants',
			'content' => $this->data['content_navigation']['variants'],
		] );
		$html .= $this->getPortlet( [
			'id' => 'p-views',
			'headerMessage' => 'views',
			'content' => $this->data['content_navigation']['views'],
		] );
		$html .= $this->getPortlet( [
			'id' => 'p-actions',
			'headerMessage' => 'actions',
			'content' => $this->data['content_navigation']['actions'],
		] );

		return $html;
	}

	/**
	 * Generates user tools menu
	 * @return string html
	 */
	private function getUserLinks() {
		return $this->getPortlet( [
			'id' => 'p-personal',
			'headerMessage' => 'personaltools',
			'content' => $this->getPersonalTools(),
		] );
	}

	/**
	 * Outputs a css clear using the core visualClear class
	 */
	private function clear() {
		echo '<div class="visualClear"></div>';
	}
}
