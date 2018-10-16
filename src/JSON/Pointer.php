<?php

namespace XTAIN\Patch\JSON;

final class Pointer implements \JsonSerializable
{
	/**
	 * @var string
	 */
	protected $pointer;

	/**
	 * Pointer constructor.
	 *
	 * @param string $pointer
	 */
	public function __construct(string $pointer)
	{
		$this->pointer = $pointer;
	}

	/**
	 * @return string
	 */
	public function getPointer(): string
	{
		return $this->pointer;
	}

	/**
	 * @param string $pointer
	 */
	public function setPointer(string $pointer): void
	{
		$this->pointer = $pointer;
	}

	/**
	 * @return string
	 */
	public function __toString() : string
	{
		return $this->pointer;
	}

	/**
	 * @return string
	 */
	public function jsonSerialize()
	{
		return $this->pointer;
	}
}
