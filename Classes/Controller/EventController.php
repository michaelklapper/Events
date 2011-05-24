<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Controller;

class EventController extends \F3\FLOW3\MVC\Controller\ActionController {

	/**
	 * @var \F3\Events\Domain\Repository\EventRepository
	 * @inject
	 */
	protected $eventRepository;

	/**
	 * @var \F3\Events\Domain\Repository\LocationRepository
	 * @inject
	 */
	protected $locationRepository;

	public function indexAction() {

        if (isset($this->settings['headline'])) {
            $this->view->assign('headline', $this->settings['headline']);
        }
		if (isset($this->settings['projectTitle'])) {
            $this->view->assign('projectTitle', $this->settings['projectTitle']);
        }
	}

    public function listAction() {
		$this->view->assign('events', $this->eventRepository->findAll());
    }

	/**
	 *
	 * @param \F3\Events\Domain\Model\Event|null $newEvent
	 * @dontValidate $newEvent
	 * @return string HTML based output
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function newAction(\F3\Events\Domain\Model\Event $newEvent = null) {
		$this->view->assign('locations', $this->locationRepository->findAll());
	}

	/**
	 *
	 * @param \F3\Events\Domain\Model\Event $event
	 * @dontValidate $event
	 * @return string HTML based output
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function deleteAction(\F3\Events\Domain\Model\Event $event) {
		$this->eventRepository->remove($event);
		$this->flashMessageContainer->add('Removed event "' . $event . '" from database.');
		$this->redirect('list');
	}

	/**
	 * @param \F3\Events\Domain\Model\Event $event
	 * @return string HTML based output
	 * @dontValidate $newEvent
	 */
	public function editAction(\F3\Events\Domain\Model\Event $event) {
		$this->view->assign('event', $event)
					->assign('locations', $this->locationRepository->findAll());

	}


	public function initializeUpdateAction() {
		$this->arguments['updateEvent']->getPropertyMappingConfiguration()->allowCreationForSubProperty('tags.tag');
		$this->arguments['updateEvent']->getPropertyMappingConfiguration()->allowCreationForSubProperty('tags');
		$this->arguments['updateEvent']->getPropertyMappingConfiguration()->allowModificationForSubProperty('tags.tag');
		$this->arguments['updateEvent']->getPropertyMappingConfiguration()->allowModificationForSubProperty('tags');
	}

	/**
	 * @param \F3\Events\Domain\Model\Event $event
	 * @return string HTML based output
	 * @dontValidate $newEvent
	 */
	public function updateAction (\F3\Events\Domain\Model\Event $updateEvent) {
		$this->eventRepository->update($updateEvent);
		$this->flashMessageContainer->add('Object "' . $updateEvent . '" was updated.');
		$this->redirect('list');
	}

	public function initializeCreateAction() {
	    $this->arguments['newEvent']->getPropertyMappingConfiguration()->allowCreationForSubProperty('tags.tag');
	}

	/**
	 * @param \F3\Events\Domain\Model\Event $event
	 * @return string HTML based output
	 * @dontValidate $newEvent
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function createAction(\F3\Events\Domain\Model\Event $newEvent) {
		$this->eventRepository->add($newEvent);
		$this->flashMessageContainer->add('New Event "' . $newEvent . '" created successfully');
		$this->redirect('index');
	}

	/**
	 * @param \F3\Events\Domain\Model\Event $event
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function showAction(\F3\Events\Domain\Model\Event $event) {
		$this->view->assign('event', $event);
	}
}
