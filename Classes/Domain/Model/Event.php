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
	 * @GeneratedValue
	 */
	protected $id;

	/**
	 * @var string
	 * @identity
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
	protected $dateBegin;

	/**
	 * @var \DateTime
	 */
	protected $dateEnd;

	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 1500)
	 */
	protected $comment;

	/**
	 * @var \F3\Events\Domain\Model\State
	 * @OneToOne
	 */
	//protected $state;

	/**
	 * @var \F3\Events\Domain\Model\Location
	 * @ManyToOne(cascade={"persist"})
	 */
	protected $location;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection<F3\Events\Domain\Model\Participant>
	 * @ManyToMany
	 */
//	protected $participants;


	 // @var \F3\Events\Domain\Model\Person\Promoter
	 // @OneToOne

	/**
	 * @var string
	 */
	protected $promoter;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection<F3\Events\Domain\Model\Tag>
	 * @ManyToMany(cascade={"persist", "remove"})
	 */
	protected $tags;

	/**
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function __construct() {
		$this->tags = new \Doctrine\Common\Collections\ArrayCollection();
		//$this->participants = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * @param \F3\Events\Domain\Model\Promoter $promoter
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setPromoter(\F3\Events\Domain\Model\Person\Promoter $promoter) {
		$this->promoter = $promoter;
	}

	/**
	 * @return \F3\Events\Domain\Model\Person\Promoter
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getPromoter() {
		return $this->promoter;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function __toString() {
		$title = $this->title;

		if ($this->location instanceof \F3\Events\Domain\Model\Location) {
			$title .= ' (' . $this->location->getTitle() . ')';
		}

		return $title;
	}

	/**
	 * @param  string $comment
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setComment($comment) {
		$this->comment = $comment;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * @param  \DateTime $dateBegin
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setDateBegin(\DateTime $dateBegin) {
		$this->dateBegin = $dateBegin;
	}

	/**
	 * @return \DateTime
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getDateBegin() {
		return $this->dateBegin;
	}

	/**
	 * @param  \DateTime $dateEnd
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setDateEnd(\DateTime $dateEnd) {
		$this->dateEnd = $dateEnd;
	}

	/**
	 * @return \DateTime
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getDateEnd() {
		return $this->dateEnd;
	}

	/**
	 * @param  string $description
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getDescription() {
		return $this->description;
	}

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
	 * @var \F3\Events\Domain\Model\Participant
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
//	public function addParticipant(\F3\Events\Domain\Model\Participant $participant) {
//		$this->participants->add($participant);
//	}

	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection<\F3\Events\Domain\Model\Participant>
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
//	public function getParticipants() {
//		return $this->participants;
//	}

	/**
	 * @param \F3\Events\Domain\Model\State $state
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
//	public function setState(\F3\Events\Domain\Model\State $state) {
//		$this->state = $state;
//	}

	/**
	 * @return \F3\Events\Domain\Model\State
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
//	public function getState() {
//		return $this->state;
//	}

	/**
	 *
	 * @param \Doctrine\Common\Collections\ArrayCollection<\F3\Events\Domain\Model\Tag> $tags
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setTags(\Doctrine\Common\Collections\ArrayCollection $tags) {
		$this->tags = $tags;
	}

	/**
	 * @param  \F3\Events\Domain\Model\Tag $tag
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function addTag(\F3\Events\Domain\Model\Tag $tag) {
		$this->tags->add($tag);
	}

	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection<\F3\Events\Domain\Model\Tag>
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getTags() {
		return $this->tags;
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
	 * @param  string $url
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getUrl() {
		return $this->url;
	}
}