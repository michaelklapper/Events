<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Domain\Model;

/**
 * Participant build the relation between a event and the concrete artists
 *
 * @date 15.05.11
 * @time 18:53
 *
 * @scope prototype
 * @entity
 *
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class Participant {

	/**
	 * @var integer
	 * @Id
	 * @GeneratedValue
	 */
	protected $id;

	/**
	 * @var \F3\Events\Domain\Model\Person\Artist
	 * @OneToOne
	 */
	protected $artist;

	/**
	 * @var \F3\Events\Domain\Model\Event
	 * @OneToOne
	 */
	protected $event;

	/**
	 * @var \F3\Events\Domain\Model\State
	 * @OneToOne
	 */
	protected $state;

	/**
	 * @param F3\Events\Domain\Model\Artist $artist
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setArtist(F3\Events\Domain\Model\Person\Artist $artist) {
		$this->artist = $artist;
	}

	/**
	 * @return F3\Events\Domain\Model\Artist
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getArtist() {
		return $this->artist;
	}

	/**
	 * @param F3\Events\Domain\Model\Event $event
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setEvent(F3\Events\Domain\Model\Event $event) {
		$this->event = $event;
	}


	/**
	 * @return \F3\Events\Domain\Model\Event
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getEvent() {
		return $this->event;
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
	 * @param  \F3\Events\Domain\Model\State $state
	 * @return void
	 */
	public function setState(\F3\Events\Domain\Model\State $state) {
		$this->state = $state;
	}

	/**
	 * @return \F3\Events\Domain\Model\Event
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getState() {
		return $this->state;
	}
}