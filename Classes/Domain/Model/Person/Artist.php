<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Domain\Model\Person;

/**
 * Artist object 
 *
 * @date 15.05.11
 * @time 17:25
 *
 * @scope prototype
 * @entity
 * 
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class Artist extends Person {

    /**
     * @var string
     * @validate StringLength(minimum = 0, maximum = 50)
     * @identity
     */
    protected $pseudonym;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection<F3\Events\Domain\Model\Instrument>
	 * @ManyToMany
     */
    protected $instruments;

	/**
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function __construct() {
		$this->instruments = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * @param \Doctrine\Common\Collections\ArrayCollection $instruments
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setInstruments($instruments) {
		$this->instruments = $instruments;
	}

	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getInstruments() {
		return $this->instruments;
	}

	/**
	 * @param \F3\Events\Domain\Model\Instrument $instrument
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function addInstrument(\F3\Events\Domain\Model\Instrument $instrument) {
		$this->instruments->add($instrument);
	}

	/**
	 * @param  string $pseudonym
	 * @return void
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function setPseudonym($pseudonym) {
		$this->pseudonym = $pseudonym;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function getPseudonym() {
		return $this->pseudonym;
	}

	/**
	 * @return string
	 *
	 * @author Michael Klapper <mick.klapper.development@gmail.com>
	 */
	public function __toString() {
		return $this->pseudonym . ' (' . $this->firstName . ' ' . $this->lastName . ')';
	}
}