<?php

namespace XTAIN\Patch\JSON\Operation;

use XTAIN\Patch\JSON\Pointer;

trait FromAwareTrait
{
	/**
	 * @var Pointer
	 */
	protected $from;

	/**
	 * @return Pointer
	 */
	public function getFrom(): Pointer
	{
		return $this->from;
	}

	/**
	 * @param Pointer $from
	 */
	public function setFrom(Pointer $from): void
	{
		$this->from = $from;
	}
}
