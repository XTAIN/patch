<?php

namespace XTAIN\Patch\JSON\Operation;

use XTAIN\Patch\JSON\Value;

trait ValueAwareTrait
{
	/**
	 * @var Value
	 */
	protected $value;

	/**
	 * @return Value
	 */
	public function getValue(): Value
	{
		return $this->value;
	}

	/**
	 * @param Value $value
	 */
	public function setValue(Value $value): void
	{
		$this->value = $value;
	}
}
