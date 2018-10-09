<?php

namespace XTAIN\Patch\JSON\Operation;

use XTAIN\Patch\JSON\Pointer;

final class Move extends AbstractOperation
{
	use FromAwareTrait;

	/**
	 * Move constructor.
	 *
	 * @param Pointer $path
	 * @param Pointer $from
	 */
	public function __construct(Pointer $path, Pointer $from)
	{
		parent::__construct($path);
		$this->setFrom($from);
	}

	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return array_merge([
			"op" => "move",
			"from" => $this->getFrom()
		], parent::jsonSerialize());
	}
}
