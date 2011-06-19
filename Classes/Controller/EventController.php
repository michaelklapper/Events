<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Controller;

use \F3\FLOW3\Error\Error;

/**
 * Manage the CRUD for Events objects
 *
 * @date 21.05.11
 * @time 22:30
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class EventController extends \F3\FLOW3\MVC\Controller\ActionController {

	/**
	 * @var \F3\Events\Domain\Repository\EventRepository
	 * @inject
	 */
	protected $eventRepository;

	/**
	 * Select special views according to format
	 *
	 * @return void
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	protected function initializeAction() {
		switch ($this->request->getFormat()) {
			case 'extdirect' :
				$this->defaultViewObjectName = 'F3\Events\View\EventView';
				$this->errorMethodName = 'extErrorAction';
				break;
			case 'json' :
				$this->defaultViewObjectName = 'F3\FLOW3\MVC\View\JsonView';
				break;
		}
	}

	/**
	 * Default action which shows the ExtJS Application.
	 *
	 * @return array
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function indexAction() {
	}

	/**
	 * @extdirect
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function listAction() {
		$events = $this->eventRepository->findAll();
		$this->view->assignEvents($events);
    }

	/**
	 * Allow creation and modification of sub object Location
	 *
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function initializeUpdateAction() {
		$this->arguments['event']->getPropertyMappingConfiguration()->allowCreationForSubProperty('location');
		$this->arguments['event']->getPropertyMappingConfiguration()->allowModificationForSubProperty('location');
	}

	/**
	 * @param \F3\Events\Domain\Model\Event $event
	 * @return string HTML based output
	 * @dontValidate $event
	 * @extdirect
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function updateAction (\F3\Events\Domain\Model\Event $event) {
		$this->eventRepository->update($event);
		$this->view->assign('value', array('success' => TRUE));
	}


	/**
	 * Allow creation and modification of sub object Location
	 *
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function initializeCreateAction() {
		$this->arguments['event']->getPropertyMappingConfiguration()->allowCreationForSubProperty('location');
		$this->arguments['event']->getPropertyMappingConfiguration()->allowModificationForSubProperty('location');
	}


	/**
	 * @param \F3\Events\Domain\Model\Event $event
	 * @return string HTML based output
	 * @dontValidate $event
	 * @extdirect
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function createAction(\F3\Events\Domain\Model\Event $event) {
		$this->eventRepository->add($event);
		$this->view->assign('value', array('success' => TRUE));
	}


	/**
	 * Allow creation and modification of sub object Location
	 *
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function initializeDestroyAction() {
		$this->arguments['event']->getPropertyMappingConfiguration()->allowCreationForSubProperty('location');
		$this->arguments['event']->getPropertyMappingConfiguration()->allowModificationForSubProperty('location');
	}

	/**
	 * @param \F3\Events\Domain\Model\Event $event
	 * @return string HTML based output
	 * @dontValidate $event
	 * @extdirect
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function destroyAction(\F3\Events\Domain\Model\Event $event) {
		$this->eventRepository->remove(
			$this->eventRepository->findOneById($event->getId())
		);
		$this->view->assign('value', array('success' => TRUE));
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
