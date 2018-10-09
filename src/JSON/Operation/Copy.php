<?php

namespace XTAIN\Patch\JSON\Operation;

use XTAIN\Patch\JSON\Pointer;

final class Copy extends AbstractOperation
{
	use FromAwareTrait;

	/**
	 * Copy constructor.
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
			"op" => "copy",
			"from" => $this->getFrom()
		], parent::jsonSerialize());
	}
}
