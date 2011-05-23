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
     * Default action
     *
     * @return string HTML based output
     * @author Michael Klapper <mick.klapper.development@gmail.com>
     */
    public function indexAction() {
    }

	/**
	 * @return string HTML based output
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function listAction() {
		$this->view->assign('locations', $this->locationRepository->findAll());
	}

	/**
	 * @param \F3\Events\Domain\Model\Location|null $newLocation
	 * @dontValidate $newLocation
	 * @return string HTML based output
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function newAction(\F3\Events\Domain\Model\Location $newLocation = null) {
	}

	/**
	 * @param \F3\Events\Domain\Model\Location $newLocation
	 * @dontValidate $newLocation
	 * @return string HTML based output
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function createAction(\F3\Events\Domain\Model\Location $newLocation) {
		$this->locationRepository->add($newLocation);
		$this->flashMessageContainer->add('Add new ' . $newLocation . ' to the repository.');
		$this->redirect('list');
	}

	/**
	 * @param \F3\Events\Domain\Model\Location $location
	 * @return string HTML based output
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function showAction(\F3\Events\Domain\Model\Location $location) {
		$this->view->assign('location', $location);
	}
}