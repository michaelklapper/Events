<?php

namespace F3\Events\ViewHelpers\ExtDirect;

/**
 * Custom ExtDirect Provider, wich supports the formHandler annotation.
 *
 * @date 24.06.11
 * @time 11:36
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class ProviderViewHelper extends \F3\ExtJS\ViewHelpers\ExtDirect\ProviderViewHelper {

	/**
	 * Returns the JavaScript to declare the Ext Direct provider for all
	 * controller actions that are annotated with @extdirect
	 *
	 * = Examples =
	 *
	 * <code title="Simple">
	 * {namespace ext=F3\ExtJS\ViewHelpers}
	 *  ...
	 * <script type="text/javascript">
	 * <ext:extdirect.provider />
	 * </script>
	 *  ...
	 * </code>
	 *
	 * TODO Cache ext direct provider config
	 * @param string $namespace The base ExtJS namespace (with dots) for the direct provider methods
	 * @return string JavaScript needed to include Ext Direct provider
	 * @api
	 */
	public function render($namespace = 'F3') {
		$providerConfig = array(
			'url' => '?F3_ExtJS_ExtDirectRequest=1&__CSRF-TOKEN=' . $this->securityContext->getCsrfProtectionToken(),
			'type' => 'remoting',
			'namespace' => $namespace,
			'actions' => array()
		);
		$controllerClassNames = $this->localReflectionService->getAllImplementationClassNamesForInterface('F3\FLOW3\MVC\Controller\ControllerInterface');
		foreach ($controllerClassNames as $controllerClassName) {
			$methodNames = get_class_methods($controllerClassName);
			foreach ($methodNames as $methodName) {
				$methodTagsValues = $this->localReflectionService->getMethodTagsValues($controllerClassName, $methodName);

				if (isset($methodTagsValues['extdirect'])) {
					$methodParameters = $this->localReflectionService->getMethodParameters($controllerClassName, $methodName);
					$requiredMethodParametersCount = 0;
					foreach ($methodParameters as $methodParameter) {
						if ($methodParameter['optional'] === TRUE) {
							break;
						}
						$requiredMethodParametersCount ++;
					}
					$extDirectAction = str_replace('\\', '_', str_replace('F3\\', '', $controllerClassName));
					$providerConfig['actions'][$extDirectAction][] = array(
						'name' => substr($methodName, 0, -6),
						'len' => $requiredMethodParametersCount,
						'formHandler' => $this->localReflectionService->isMethodTaggedWith($controllerClassName, $methodName, 'formHandler')
					);
				}
			}
		}

		return 'Ext.Direct.addProvider(' . json_encode($providerConfig) . ');' . chr(10);
	}
}
