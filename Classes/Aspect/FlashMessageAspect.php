<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Aspect;

/**
 * Aspect to wrap a div.info around the list.
 *
 * @date 23.05.11
 * @time 20:39
 * @aspect
 * 
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class FlashMessageAspect {

	/**
	 * @var \F3\FLOW3\Log\LoggerInterface A logger implementation
	 */
	protected $logger;

	/**
	 * For logging we need a logger, which we will get injected automatically by
	 * the Object Manager
	 *
	 * @param  \F3\FLOW3\Log\SystemLoggerInterface $logger The System Logger
	 * @return void
	 */
	public function injectSystemLogger(\F3\FLOW3\Log\SystemLoggerInterface $systemLogger) {
		$this->logger = $systemLogger;
	}

	/**
	 * Before advice, logs all access to methods of our package
	 *
	 * @param  \F3\FLOW3\AOP\JoinPointInterface $joinPoint: The current join point
	 * @return void
	 * @before method(F3\Fluid\ViewHelpers\FlashMessagesViewHelper->render())
	 */
	public function logMethodExecution(\F3\FLOW3\AOP\JoinPointInterface $joinPoint) {
		$logMessage = '___________ ---------- The method ' . $joinPoint->getMethodName() . ' in class ' .
		    $joinPoint->getClassName() . ' has been called.';
		$this->logger->log($logMessage);
	}

    /**
     * Wraps an additional "div.info" around the HTML list.
     *
	 * @param  \F3\FLOW3\AOP\JoinPointInterface $joinPoint The current join point
	 * @around method(F3\Fluid\ViewHelpers\FlashMessagesViewHelper->render())
	 *
	 * @return mixed Result of the target method
	 *
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    public function wrapAdditionalDivAround(\F3\FLOW3\AOP\JoinPointInterface $joinPoint) {
		$wrapAround = '<div class="info">%s</div>';
		$result     = $joinPoint->getAdviceChain()->proceed($joinPoint);
		$content    = '';

		if (! empty($result)) {
			$content = sprintf($wrapAround, $result);
		}

		return $content;
    }
}