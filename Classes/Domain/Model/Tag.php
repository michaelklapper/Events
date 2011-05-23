<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Domain\Model;

/**
 * Tag object which can be added to an Location or an Event
 *
 * @date 15.05.11
 * @time 18:22
 *
 * @scope prototype
 * @entity
 * 
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class Tag {

	/**
	 * @var integer
	 * @Id
	 * @GeneratedValue
	 */
	protected $id;

	/**
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 50)
	 */
	protected $title;

	/**
	 * @param  integer $id
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return int
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param  string $title
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function __toString() {
		return $this->title;
	}
}