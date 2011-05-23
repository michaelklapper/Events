<?php
declare(ENCODING = 'utf-8');
namespace F3\Events\Domain\Model\Person;

/**
 * Promoter object
 *
 * @date 15.05.11
 * @time 17:26
 *
 * @scope prototype
 * @entity
 * 
 * @author Michael Klapper <mick.klapper.development@gmail.com>
 */
class Promoter extends Person {

    /**
     * @var string
     * @validate StringLength(minimum = 0, maximum = 50)
     * @identity
     */
    protected $pseudonym;

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
}