<?php

namespace XTAIN\Patch\JSON\Operation;

use XTAIN\Patch\JSON\Pointer;
use XTAIN\Patch\JSON\Value;

final class Add extends AbstractOperation
{
	use ValueAwareTrait;

	/**
	 * Add constructor.
	 *
	 * @param Pointer $path
	 * @param Value   $value
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
			"op" => "add",
			"value" => $this->getValue()
		], parent::jsonSerialize());
	}
}
