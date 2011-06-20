<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Service;

/**
 * Service to manage notification on state changes in relevant stages.
 *
 * @date 23.06.11
 * @time 00:39
 * @aspect
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class StateNotification extends \F3\FLOW3\MVC\Controller\ActionController {

	/**
	* @var \F3\FLOW3\Log\LoggerInterface A logger implementation
	*/
	protected $logger;

	/**
	 * For logging we need a logger, which we will get injected automatically by
	 * the Object Manager
	 *
	 * @param \F3\FLOW3\Log\SystemLoggerInterface $systemLogger
	 *
	 * @internal param \F3\FLOW3\Log\SystemLoggerInterface $logger The System Logger
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function injectSystemLogger(\F3\FLOW3\Log\SystemLoggerInterface $systemLogger) {
		$this->logger = $systemLogger;
	}

	/**
	 * Before advice, logs all access to methods of our package
	 *
	 * @param \F3\FLOW3\AOP\JoinPointInterface $joinPoint: The current join point
	 * @return void
	 *
	 * @after method(F3\Events\Domain\Model\Event->setState())
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function sendNotificationOnState(\F3\FLOW3\AOP\JoinPointInterface $joinPoint) {
		$state = $joinPoint->getMethodArgument('state');
		$message = '';

		if ($state->getId() === 5) {
			$message = 'Events state was changed to: ' . $state->getTitle();
			$this->logger->log($message);
		}
	}
}