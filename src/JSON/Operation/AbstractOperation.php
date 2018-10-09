<?php

namespace XTAIN\Patch\JSON\Operation;

use XTAIN\Patch\JSON\Pointer;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class AbstractOperation
 *
 * @Serializer\Discriminator(
 *     field="op",
 *     disabled=false,
 *     map={
 *         "add": "XTAIN\Patch\JSON\Operation\Add",
 *         "copy": "XTAIN\Patch\JSON\Operation\Copy",
 *         "move": "XTAIN\Patch\JSON\Operation\Move",
 *         "remove": "XTAIN\Patch\JSON\Operation\Remove",
 *         "replace": "XTAIN\Patch\JSON\Operation\Replace",
 *         "test": "XTAIN\Patch\JSON\Operation\Test"
 *     }
 * )
 * @package XTAIN\Patch\JSON\Operation
 */
abstract class AbstractOperation implements \JsonSerializable
{
	/**
	 * @var Pointer
	 * @Serializer\Type("XTAIN\Patch\JSON\Pointer")
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
