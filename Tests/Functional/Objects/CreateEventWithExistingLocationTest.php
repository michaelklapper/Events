<?php

namespace F3\Events\Tests\Functional\Objects;

/**
 * @date 19.06.11
 * @time 15:42
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class CreateEventWithExistingLocationTest extends \F3\FLOW3\Tests\FunctionalTestCase {

	/**
	 * @var boolean
	 */
	static protected $testablePersistenceEnabled = true;

	/**
	 * @var \F3\Events\Domain\Repository\EventRepository
	 */
	protected $eventRepository;

	/**
	 * @var \F3\Events\Domain\Repository\LocationRepository
	 */
	protected $locationRepository;

	/**
	 * @var array
	 */
	protected $eventProperties = array(
			'title' => 'dummy',
			'date' => '2011-12-02',
			'timeBegin' => '12:59 AM',
			'timeEnd' => '13:59 AM',
			'description' => 'Some description',
			'comment' => 'Some comment',
			'url' => 'http://www.morphodo.com/',
		);

	/**
	 * @var array
	 */
	protected $locationProperties = array(
		'title' => 'Office',
		'street' => 'some street',
		'number' => '12b',
		'zip'	=> 12121,
		'city' => 'Wiesbaden',
		'country' => 'Germany'
	);

	/**
	 * Initialize repositories
	 */
	public function setUp() {
		parent::setUp();
		$this->eventRepository = new \F3\Events\Domain\Repository\EventRepository;
		$this->locationRepository = new \F3\Events\Domain\Repository\LocationRepository;
	}

	/**
	 * @test
	 * @return void
	 */
	public function createEventsWithExistingLocation() {
		$this->locationRepository->add($this->buildLocation(array('title' => 'NORDAKADEMIE')));
		$this->locationRepository->add($this->buildLocation(array('title' => 'Campus Sursee')));

			// store the new locations in database
		$this->persistenceManager->persistAll();

		$arguments = array(
			'event' => array(
				'title' => 'T3DD11',
				'date' => '2011-12-02',
				'timeBegin' => '12:59 AM',
				'timeEnd' => '13:59 AM',
				'description' => 'Some description',
				'comment' => 'Some comment',
				'url' => 'http://www.google.de/',
				'location' => array(
					'__identity' => '2',
					'id' => 2,
					'title' => 'Campus Sursee',
					'street' => 'Ruedesheimer',
					'number' => '12b',
					'zip'	=> 12121,
					'city' => 'Wiesbaden',
					'country' => 'Germany'
				)
			)
		);

		$this->sendWebRequest('Event', 'Events', 'create', $arguments, $format = 'html');

			// store the new event in database
		$this->persistenceManager->persistAll();

		$eventCollection = $this->eventRepository->findAll();
		$event = $eventCollection->getFirst();
		$location = $event->getLocation();

		$this->assertEquals(1, $event->getId()); // Is our first created events.
		$this->assertEquals($arguments['event']['title'], $event->getTitle());
		$this->assertEquals('Campus Sursee', $location->getTitle());
	}

	/**
	 * @param array $overrideProperties
	 *
	 * @return \F3\Events\Domain\Model\Location
	 */
	protected function buildLocation(array $overrideProperties) {
		$locationProperties = array_merge($this->locationProperties, $overrideProperties);
		$location = new \F3\Events\Domain\Model\Location;
		$propertyNames = \F3\FLOW3\Reflection\ObjectAccess::getSettablePropertyNames($location);

		foreach ($propertyNames as $propertyName) {
			if (isset($locationProperties[$propertyName])) {
				\F3\FLOW3\Reflection\ObjectAccess::setProperty($location, $propertyName, $locationProperties[$propertyName], true);
			}
		}

		return $location;
	}

	/**
	 * @param array $overrideProperties
	 *
	 * @return \F3\Events\Domain\Model\Event
	 */
	protected function buildEvent(array $overrideProperties) {
		$eventProperties = array_merge($this->eventProperties, $overrideProperties);
		$event = new \F3\Events\Domain\Model\Event;
		$propertyNames = \F3\FLOW3\Reflection\ObjectAccess::getSettablePropertyNames($event);

		foreach ($propertyNames as $propertyName) {
			if (isset($eventProperties[$propertyName])) {
				\F3\FLOW3\Reflection\ObjectAccess::setProperty($event, $propertyName, $eventProperties[$propertyName], true);
			}
		}

		return $event;
	}

}
