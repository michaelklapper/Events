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
	 * Contains the settings of the current package
	 * @var array
	 */
	protected $settings;

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
	 * Injects the settings of the package this controller belongs to.
	 *
	 * @param array $settings Settings container of the current package
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function injectSettings(array $settings) {
		$this->settings = $settings;
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
	public function sendNotificationOnStateCanceled(\F3\FLOW3\AOP\JoinPointInterface $joinPoint) {
		$state = $joinPoint->getMethodArgument('state');
		$proxy = $joinPoint->getProxy();
		$message = '';

		if ($state->getId() === $this->settings['StageNotification']['canceled']) {
			$message = 'CANCELED: Event "' . $proxy->getTitle() . '" state was changed to: ' . $state->getTitle();
			$this->logger->log($message);
		}
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
	public function sendNotificationOnStateApproved(\F3\FLOW3\AOP\JoinPointInterface $joinPoint) {
		$state = $joinPoint->getMethodArgument('state');
		$proxy = $joinPoint->getProxy();
		$message = '';

		if ($state->getId() === $this->settings['StageNotification']['approved']) {
			$message = 'APPROVED: Event "' . $proxy->getTitle() . '" state was changed to: ' . $state->getTitle();
			$this->logger->log($message);
		}
	}
}