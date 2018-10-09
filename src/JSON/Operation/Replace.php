<?php

namespace XTAIN\Patch\JSON\Operation;

use XTAIN\Patch\JSON\Pointer;
use XTAIN\Patch\JSON\Value;

final class Replace extends AbstractOperation
{
	use ValueAwareTrait;

	/**
	 * Replace constructor.
	 *
	 * @param Pointer $path
	 * @param Value $value
	 */
	public function __construct(Pointer $path, Value $value)
	{
		parent::__construct($path);
		$this->setValue($value);
	}

	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return array_merge([
			"op" => "replace",
			"value" => $this->getValue()
		], parent::jsonSerialize());
	}
}
