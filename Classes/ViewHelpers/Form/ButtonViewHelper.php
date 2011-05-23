<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\ViewHelpers\Form;

/**
 * Creates a button.
 *
 * @scope prototype
 */
class ButtonViewHelper extends \F3\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper {

	/**
	 * @var string
	 */
	protected $tagName = 'button';

	/**
	 * Initialize the arguments.
	 *
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');
		$this->registerUniversalTagAttributes();
	}

	/**
	 * Renders the submit button.
	 *
	 * @param string $type
	 * @param string $imageSrc
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function render($type = 'submit', $imageSrc = '') {
		$name = $this->getName();
		$this->registerFieldNameForFormTokenGeneration($name);

		$this->tag->addAttribute('type', $type);
		$this->tag->addAttribute('name', $name);
		if (! empty($imageSrc)) {
			$this->tag->setContent('<img src="' . $imageSrc . '" />' . $this->getValue());
		} else {
			$this->tag->setContent($this->getValue());
		}

		return $this->tag->render();
	}
}

?>