<?php

namespace XTAIN\Patch\JSON;

final class Value implements \JsonSerializable
{
	/**
	 * @var mixed
	 */
	private $value;

	/**
	 * Value constructor.
	 *
	 * @param string $value
	 */
	public function __construct($value)
	{
		$this->value = $value;
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param mixed $value
	 */
	public function setValue($value): void
	{
		$this->value = $value;
	}

	/**
	 * @return mixed
	 */
	public function jsonSerialize()
	{
		return $this->value;
	}
}
