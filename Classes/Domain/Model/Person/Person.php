<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Domain\Model\Person;

/**
 * Abstract person object
 *
 * @date 15.05.11
 * @time 17:00
 *
 * @abstract
 * 
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
abstract class Person {

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
    protected $firstName;

    /**
     * @var string
     * @validate StringLength(minimum = 3, maximum = 50)
     */
    protected $lastName;

    /**
     * @var string
     * @validator EmailAddress
     */
    protected $email;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var string
     * @validate StringLength(minimum = 10, maximum = 50)
     */
    protected $phoneWork;

    /**
     * @var string
     * @validate StringLength(minimum = 10, maximum = 50)
     */
    protected $phoneMobile;

	/**
	 * @param  boolean $active
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setActive($active) {
		$this->active = $active;
	}

	/**
	 * @return bool
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getActive() {
		return $this->active;
	}

	/**
	 * @param  string $email
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param  string $firstName
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getFirstName() {
		return $this->firstName;
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
	 * @param  string $lastName
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @param  string $phoneMobile
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setPhoneMobile($phoneMobile) {
		$this->phoneMobile = $phoneMobile;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getPhoneMobile() {
		return $this->phoneMobile;
	}

	/**
	 * @param  string $phoneWork
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setPhoneWork($phoneWork) {
		$this->phoneWork = $phoneWork;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getPhoneWork() {
		return $this->phoneWork;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function __toString() {
		return $this->firstName . ' ' . $this->lastName;
	}
}