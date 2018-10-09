<?php

namespace XTAIN\Patch\JSON\Operation;

use XTAIN\Patch\JSON\Value;
use JMS\Serializer\Annotation as Serializer;

trait ValueAwareTrait
{
	/**
	 * @var Value
	 * @Serializer\Type("XTAIN\Patch\JSON\Value")
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
