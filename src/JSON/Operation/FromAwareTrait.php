<?php

namespace XTAIN\Patch\JSON\Operation;

use XTAIN\Patch\JSON\Pointer;
use JMS\Serializer\Annotation as Serializer;

trait FromAwareTrait
{
	/**
	 * @var Pointer
	 * @Serializer\Type("XTAIN\Patch\JSON\Pointer")
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
