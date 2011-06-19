<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Domain\Model;

/**
 * Event object which collects location, tags and participants
 *
 * @date 15.05.11
 * @time 18:31
 *
 * @scope prototype
 * @entity
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class Event {

	/**
	 * @var integer
	 * @Id
	 * @identity
	 * @GeneratedValue
	 */
	protected $id;

	/**
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 50)
	 */
	protected $title;

	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 1500)
	 */
	protected $description;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * @var string
	 */
	protected $timeBegin;

	/**
	 * @var string
	 */
	protected $timeEnd;

	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 1500)
	 */
	protected $comment;

	/**
	 * @var \F3\Events\Domain\Model\Location
	 * @ManyToOne(cascade={"all"})
	 */
	protected $location;

	/**
	 * @var \F3\Events\Domain\Model\State
	 * @ManyToOne(cascade={"all"})
	 */
	protected $state;

	/**
	 * @param string $comment
	 */
	public function setComment($comment) {
		$this->comment = $comment;
	}

	/**
	 * @return string
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * @param \DateTime $date
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * @return \DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param string $timeBegin
	 */
	public function setTimeBegin($timeBegin) {
		$this->timeBegin = $timeBegin;
	}

	/**
	 * @return string
	 */
	public function getTimeBegin() {
		return $this->timeBegin;
	}

	/**
	 * @param string $timeEnd
	 */
	public function setTimeEnd($timeEnd) {
		$this->timeEnd = $timeEnd;
	}

	/**
	 * @return string
	 */
	public function getTimeEnd() {
		return $this->timeEnd;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $url
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param  \F3\Events\Domain\Model\Location $location
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setLocation(\F3\Events\Domain\Model\Location $location) {
		$this->location = $location;
	}

	/**
	 * @return \F3\Events\Domain\Model\Location
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * @param  \F3\Events\Domain\Model\State $state
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setState(\F3\Events\Domain\Model\State $state) {
		$this->state = $state;
	}

	/**
	 * @return \F3\Events\Domain\Model\State
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getState() {
		return $this->state;
	}
}