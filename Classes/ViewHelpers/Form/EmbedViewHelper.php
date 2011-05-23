<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\ViewHelpers\Form;
/*                                                                        *
 * This script belongs to the FLOW3 package "Fluid".                      *
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

/**
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 * @scope prototype
 *
 * @api
 */
class EmbedViewHelper extends \F3\Fluid\ViewHelpers\Form\AbstractFormViewHelper {

	/**
	 * Initialize arguments.
	 *
	 * @return void
	 *
	 * @author Tolleiv Nietsch<tolleiv.nietsch@gmail.com>
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 * @author Thomas Layh <thomas.layh@gmail.com>
	 * @api
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('property', '', 'Associative array with internal IDs as key, and the values are displayed in the select box', TRUE);
		$this->registerArgument('as', '', 'Associative array with internal IDs as key, and the values are displayed in the select box', TRUE);
	}

	/**
	 * Render the tag.
	 *
	 * @return string rendered tag.
	 *
	 * @author Tolleiv Nietsch<tolleiv.nietsch@gmail.com>
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 * @author Thomas Layh <thomas.layh@gmail.com>
	 * @api
	 */
	public function render() {
		$content = '';
		$formObject = $this->viewHelperVariableContainer->get('F3\Fluid\ViewHelpers\FormViewHelper', 'formObject');
		$formObjectName = $this->viewHelperVariableContainer->get('F3\Fluid\ViewHelpers\FormViewHelper', 'formObjectName');
		$elementCollection = \F3\FLOW3\Reflection\ObjectAccess::getProperty($formObject, $this->arguments['property']);
		$i = 0;
		$as = $this->arguments['as'];
		$propertyName = $this->arguments['property'];

		foreach($elementCollection as $key => $singleElement) {
            $this->templateVariableContainer->add($as, $singleElement);
            $this->viewHelperVariableContainer->addOrUpdate('F3\Fluid\ViewHelpers\FormViewHelper', 'formObjectName', $formObjectName.'[' . $propertyName . ']['.$i.']');
			$this->viewHelperVariableContainer->addOrUpdate('F3\Fluid\ViewHelpers\FormViewHelper', 'formObject', $singleElement);
            $content.= $this->renderChildren();
            $this->viewHelperVariableContainer->addOrUpdate('F3\Fluid\ViewHelpers\FormViewHelper', 'formObjectName', $formObjectName);

            $this->templateVariableContainer->remove($as);
            $i++;
        }

		return $content;
	}
}

?>