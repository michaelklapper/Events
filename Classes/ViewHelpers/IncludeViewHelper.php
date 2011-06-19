<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\ViewHelpers;

/**
 * Include ExtJS view helper
 *
 * @scope prototype
 */
class IncludeViewHelper extends \F3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @inject
	 * @var \F3\FLOW3\Resource\Publishing\ResourcePublisher
	 */
	protected $resourcePublisher;

	/**
	 * @inject
	 * @var \F3\FLOW3\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * Returns the HTML needed to include ExtJS, that is, CSS and JS includes.
	 *
	 * = Examples =
	 *
	 * <code title="Simple">
	 * {namespace ext=F3\ExtJS\ViewHelpers}
	 *  ...
	 * <ext:include/>
	 * </code>
	 * Renders the script and link tags needed to include everything needed to
	 * use ExtJS.
	 *
	 * <code title="Use a specific theme">
	 * <ext:include theme="xtheme-gray"/>
	 * </code>
	 *
	 * @param string $theme The theme to include, simply the name of the CSS
	 * @param boolean $debug Whether to use the debug version of ExtJS
	 * @param boolean $includeStylesheets Include ExtJS CSS files if true
	 * @return string HTML needed to include ExtJS
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 * @api
	 */
	public function render($theme = 'xtheme-blue', $debug = NULL, $includeStylesheets = TRUE) {
		if ($debug === NULL) {
			$debug = ($this->objectManager->getContext() === 'Development') ?: FALSE;
		}
		$baseUri = $this->resourcePublisher->getStaticResourcesWebBaseUri() . 'Packages/Events/';
		$output = '';
		if ($includeStylesheets) {
			$output .= '
<link rel="stylesheet" href="' . $baseUri . 'CSS/sencha/ext-all.css" />';
		}
		if ($debug) {
			$output .= '
<script type="text/javascript" src="' . $baseUri . 'JavaScript/Ext/ext-all-debug.js"></script>
<script type="text/javascript" src="' . $baseUri . 'JavaScript/Ext/ux/StatusBar.js"></script>';
		} else {
			$output .= '
<script type="text/javascript" src="' . $baseUri . 'JavaScript/ext-all.js"></script>
<script type="text/javascript" src="' . $baseUri . 'JavaScript/Ext/ux/StatusBar.js"></script>';
		}

		return $output;
	}
}

?>
