<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\View;

/**
 * Custom view with some special initialisation for the output formatting
 *
 * @date 03.06.11
 * @time 20:10
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 * @scope prototype
 */
class EventView extends \F3\ExtJS\ExtDirect\View {

	/**
	 * Wrapper to assign events to the view including
	 * the view configuration and success state.
	 *
	 * @param mixed $events
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
    public function assignEvents($events) {
		$this->setConfiguration(array(
			'value' => array(
				'data' => array(
					'_descendAll' => array(
						'_descend' => array(
							'date' => array(),
							'location' => array(
								'_exposeObjectIdentifier' => true,
								'_exclude' => array('__isInitialized__')
							),
							'state' => array(
								'_exposeObjectIdentifier' => true,
								'_exclude' => array('__isInitialized__')
							),
						),
					)
				)
			)
		));
		$this->assign('value', array('data' => $events, 'success' => TRUE));
    }

	/**
	 * Wrapper to assign locations to the view including success state.
	 *
	 * @param mixed $locations
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
    public function assignLocations($locations) {
		$this->setConfiguration(array(
			'value' => array(
				'data' => array(
					'_descendAll' => array(
						'_exposeObjectIdentifier' => true,
						'_exclude' => array('__isInitialized__')
					)
				)
			)
		));
		$this->assign('value', array('data' => $locations, 'success' => TRUE));
    }

	/**
	 * Wrapper to assign locations to the view including success state.
	 *
	 * @param mixed $states
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
    public function assignStates($states) {
		$this->setConfiguration(array(
			'value' => array(
				'data' => array(
					'_descendAll' => array(
						'_exposeObjectIdentifier' => true,
						'_exclude' => array('__isInitialized__')
					)
				)
			)
		));
		$this->assign('value', array('data' => $states, 'success' => TRUE));
    }

	/**
	 * Assigns errors to the view and converts them to a format that Ext JS
	 * understands.
	 *
	 * @param \F3\FLOW3\Error\Result $result Errors e.g. from mapping results
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function assignErrors(\F3\FLOW3\Error\Result $result) {
		$errors = $result->getFlattenedErrors();
		$output = array();

		foreach ($errors as $propertyPath => $propertyErrors) {
			$propertyArray = explode('.', $propertyPath);
			array_shift($propertyArray);
			$message = '';
			foreach ($propertyErrors as $propertyError) {
				$message .= $propertyError->getMessage();
			}
			$output[implode('.', $propertyArray)] = $message;
		}
		$this->assign('value', array(
			'errors' => $output,
			'success' => FALSE
		));
	}
}