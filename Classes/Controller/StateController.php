<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Controller;

/**
 * Manage State actions
 *
 * @date 19.06.11
 * @time 20:25
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class StateController extends \F3\FLOW3\MVC\Controller\ActionController {

	/**
	 * @var \F3\Events\Domain\Repository\StateRepository
	 * @inject
	 */
	protected $stateRepository;

	/**
	 * Select special views for ExtDirect.
	 *
	 * @return void
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	protected function initializeAction() {
		$this->defaultViewObjectName = 'F3\Events\View\EventView';
		$this->errorMethodName = 'extErrorAction';
	}

    /**
     * Default action
     *
	 * @extdirect
     * @return string
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    public function indexAction () {
		$this->redirect('list');
    }

	/**
	 * List all available states
	 *
	 * @extdirect
	 * @return string
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function listAction() {
		$stateCollection = $this->stateRepository->findAll();
		$this->view->assignStates($stateCollection);
	}

	/**
	 * A preliminary error action for handling validation errors
	 * by assigning them to the ExtDirect View that takes care of
	 * converting them.
	 *
	 * @return void
	 */
	public function extErrorAction() {
		$this->view->assignErrors($this->arguments->getValidationResults());
	}
}