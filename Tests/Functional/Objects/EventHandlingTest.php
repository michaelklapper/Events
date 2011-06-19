<?php

namespace F3\Events\Tests\Functional\Objects;

/**
 * @date 19.06.11
 * @time 15:42
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class EventHandlingTest extends \F3\FLOW3\Tests\FunctionalTestCase {

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
			'title' => 'Robert Skaarhoj',
			'date' => '2011-12-02',
			'timeBegin' => '12:59 AM',
			'timeEnd' => '13:59 AM',
			'description' => 'Some description',
			'comment' => 'Some comment',
			'url' => 'http://www.google.de/',
		);

	/**
	 * @var array
	 */
	protected $locationProperties = array(
		'title' => 'BarCamp',
		'street' => 'Ruedesheimer',
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
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function createNewEventWithLocation() {
		$arguments['event'] = $this->eventProperties;
		$arguments['event']['location'] = $this->locationProperties;

		$this->sendWebRequest('Event', 'Events', 'create', $arguments, $format = 'html');

		$this->persistenceManager->persistAll();

		$eventCollection = $this->eventRepository->findAll();
		$event = $eventCollection->getFirst();
		$location = $event->getLocation();

		$this->assertEquals(1, $eventCollection->count());
		$this->assertEquals(1, $this->locationRepository->findAll()->count());

		$this->assertSame($arguments['event']['title'], $event->getTitle());
		$this->assertSame($arguments['event']['date'], $event->getDate()->format('Y-m-d'));
		$this->assertSame($arguments['event']['timeBegin'], $event->getTimeBegin());
		$this->assertSame($arguments['event']['timeEnd'], $event->getTimeEnd());
		$this->assertSame($arguments['event']['description'], $event->getDescription());
		$this->assertSame($arguments['event']['comment'], $event->getComment());
		$this->assertSame($arguments['event']['url'], $event->getUrl());

		$this->assertSame($arguments['event']['location']['title'], $location->getTitle());
		$this->assertSame($arguments['event']['location']['street'], $location->getStreet());
		$this->assertSame($arguments['event']['location']['number'], $location->getNumber());
		$this->assertSame($arguments['event']['location']['zip'], $location->getZip());
		$this->assertSame($arguments['event']['location']['city'], $location->getCity());
		$this->assertSame($arguments['event']['location']['country'], $location->getCountry());
	}
}
