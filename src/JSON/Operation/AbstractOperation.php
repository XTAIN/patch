<?php

namespace XTAIN\Patch\JSON\Operation;

use XTAIN\Patch\JSON\Pointer;

/**
 * Class AbstractOperation
 *
 * @package XTAIN\Patch\JSON\Operation
 */
abstract class AbstractOperation implements \JsonSerializable
{
	/**
	 * @var Pointer
	 */
	protected $path;

	/**
	 * AbstractOperation constructor.
	 *
	 * @param Pointer $path
	 */
	public function __construct(Pointer $path)
	{
		$this->path = $path;
	}

	/**
	 * @return Pointer
	 */
	public function getPath(): Pointer
	{
		return $this->path;
	}

	/**
	 * @param Pointer $path
	 */
	public function setPath(Pointer $path): void
	{
		$this->path = $path;
	}

	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return [
			"path" => $this->path
		];
	}
}
