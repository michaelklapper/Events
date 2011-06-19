<?php

namespace F3\Events\Tests\Functional\Converter;

/**
 *
 * @date 18.06.11
 * @time 11:20
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class EventConverterTest extends \F3\FLOW3\Tests\FunctionalTestCase {

	/**
	 * @var boolean
	 */
	static protected $testablePersistenceEnabled = true;

	/**
	 *
	 * @var \F3\FLOW3\Property\PropertyMapper
	 */
	protected $propertyMapper;

	/**
	 * @return void
	 * @author Sebastian Kurfürst <sebastian@typo3.org>
	 */
	public function setUp() {
		parent::setUp();
		$this->propertyMapper = $this->objectManager->get('F3\FLOW3\Property\PropertyMapper');
	}

	/**
	 * @test
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function convertSimpleEventObject() {
		$source = array(
			'title' => 'Robert Skaarhoj',
			'date' => '2011-12-02',
			'timeBegin' => '12:59 AM',
			'timeEnd' => '13:59 AM',
			'description' => 'Some description',
			'comment' => 'Some comment',
			'url' => 'http://www.google.de/',
		);

		$result = $this->propertyMapper->convert($source, 'F3\Events\Domain\Model\Event');

		$this->assertSame($source['title'], $result->getTitle());
		$this->assertSame($source['date'], $result->getDate()->format('Y-m-d'));
		$this->assertSame($source['description'], $result->getDescription());
		$this->assertSame($source['timeBegin'], $result->getTimeBegin());
		$this->assertSame($source['timeEnd'], $result->getTimeEnd());
		$this->assertSame($source['comment'], $result->getComment());
		$this->assertSame($source['url'], $result->getUrl());
	}


}