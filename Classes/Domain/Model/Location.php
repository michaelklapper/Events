<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Domain\Model;

/**
 * Location description for an event
 *
 * @date 15.05.11
 * @time 18:04
 *
 * @scope prototype
 * @entity
 * 
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class Location {

	/**
	 * @var integer
	 * @Id
	 * @GeneratedValue
	 */
	protected $id;

	/**
	 * @var string
	 * @identity
	 * @validate StringLength(minimum = 3, maximum = 120)
	 */
	protected $title;

	/**
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 50)
	 */
	protected $street;

	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 9)
	 */
	protected $number;

	/**
	 * @var integer
	 */
	protected $zip;

	/**
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 50)
	 */
	protected $city;

	/**
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 50)
	 */
	protected $country;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection<F3\Events\Domain\Model\Contact>
	 */
	protected $contacts;

	/**
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function __construct() {
		$this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * @param  string $city
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param \F3\Events\Domain\Model\Person\Contact $contact
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function addContact(\F3\Events\Domain\Model\Person\Contact $contact) {
		$this->contacts->add($contact);
	}

	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection<F3\Events\Domain\Model\Contact>
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getContacts() {
		return $this->contacts;
	}

	/**
	 * @param  string $country
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getCountry() {
		return $this->country;
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
	 * @param  string $number
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setNumber($number) {
		$this->number = $number;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * @param  string $street
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getStreet() {
		return $this->street;
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
	 * @param  integer $zip
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * @return int
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function __toString() {
		return $this->title . ' (' . $this->city . ')';
	}
}