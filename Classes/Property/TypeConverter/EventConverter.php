<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Property\TypeConverter;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use \F3\FLOW3\Error\Error;

/**
 * Converter which transforms a string to a boolean, by simply casting it.
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @scope singleton
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class EventConverter extends \F3\FLOW3\Property\TypeConverter\ArrayToObjectConverter {

	/**
	 * @var \F3\FLOW3\I18n\Service
	 * @inject
	 */
	protected $localizationService;

	/**
	 * @var \F3\FLOW3\I18n\Formatter\DatetimeFormatter
	 * @inject
	 */
	protected $dateTimeFormatter;

	/**
	 * @var \F3\FLOW3\I18n\Parser\DatetimeParser
	 * @inject
	 */
	protected $dateTimeParser;

	/**
	 * @var \F3\FLOW3\Persistence\PersistenceManagerInterface
	 * @inject
	 */
	protected $persistenceManager;

	/**
	 * @var array<string>
	 */
	protected $sourceTypes = array('array');

	/**
	 * @var string
	 */
	protected $targetType = 'F3\Events\Domain\Model\Event';

	/**
	 * @var integer
	 */
	protected $priority = 1;

	/**
	 * Actually convert from $source to $targetType, by doing a typecast.
	 *
	 * @param string $source
	 * @param string $targetType
	 * @param array $subProperties
	 * @param \F3\FLOW3\Property\PropertyMappingConfigurationInterface $configuration
	 * @return \DateTime
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function convertFrom($source, $targetType, array $subProperties = array(), \F3\FLOW3\Property\PropertyMappingConfigurationInterface $configuration = NULL) {
		$event = new \F3\Events\Domain\Model\Event;
		$propertyNames = \F3\FLOW3\Reflection\ObjectAccess::getSettablePropertyNames($event);

		//!FIXME change that to proper date handle
		$dateArray = explode('T', $source['date']);
		$source['date'] = new \DateTime($dateArray[0]);

		if (is_array($source) && array_key_exists('id', $source) && $source['id'] == '' || $source['id'] == 0) {
			unset($source['id']);
		}

		foreach ($propertyNames as $propertyName) {
			if (isset($source[$propertyName])) {
				\F3\FLOW3\Reflection\ObjectAccess::setProperty($event, $propertyName, $source[$propertyName], true);
			}
		}

//		if (is_array($source) && array_key_exists('id', $source) && $source['id'] == '' || $source['id'] == 0) {
//			unset($source['id']);
//		}
//		if (is_array($source) && array_key_exists('__identity', $source) && $source['__identity'] == '' || $source['__identity'] == 0) {
//			unset($source['__identity']);
//		}
//		return parent::convertForm(null, $targetType, $source);

		return $event;
	}
}
