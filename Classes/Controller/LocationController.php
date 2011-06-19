<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Controller;

/**
 * Manage the CRUD for Location objects
 *
 * @date 21.05.11
 * @time 22:30
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class LocationController extends \F3\FLOW3\MVC\Controller\ActionController {

	/**
	 * @var \F3\Events\Domain\Repository\LocationRepository
	 * @inject
	 */
	protected $locationRepository;

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
     * @return string HTML based output
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    public function indexAction() {
		$this->redirect('list');
    }

	/**
	 * @extdirect
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function listAction() {
		$this->view->assignLocations($this->locationRepository->findAll());
	}

	/**
	 * @param \F3\Events\Domain\Model\Location $location
	 * @dontValidate $location
	 * @extdirect
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function createAction(\F3\Events\Domain\Model\Location $location) {
		$this->locationRepository->add($location);
		$this->view->assignLocations(null);
	}

	/**
	 * @param \F3\Events\Domain\Model\Location $location
	 * @dontValidate $location
	 * @extdirect
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function updateAction(\F3\Events\Domain\Model\Location $location) {
		$this->locationRepository->update($location);
	}

	/**
	 * @param \F3\Events\Domain\Model\Location $location
	 * @dontValidate $location
	 * @extdirect
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function readAction(\F3\Events\Domain\Model\Location $location) {
		$this->view->assignLocations($location);
	}

	/**
	 * @param \F3\Events\Domain\Model\Location $location
	 * @dontValidate $location
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function destroyAction(\F3\Events\Domain\Model\Location $location) {
		$this->locationRepository->remove(
			$this->locationRepository->findOneById($location->getId())
		);
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