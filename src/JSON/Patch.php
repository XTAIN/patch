<?php

namespace XTAIN\Patch\JSON;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;
use XTAIN\Patch\JSON\Operation\AbstractOperation;
use XTAIN\Patch\PatchInterface;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Patch
 *
 * @package XTAIN\Patch\JSON
 */
class Patch implements \JsonSerializable, PatchInterface
{
	/**
	 * @var AbstractOperation[]
	 */
	protected $operations = [];

	/**
	 * @return AbstractOperation[]
	 */
	public function getOperations(): array
	{
		return $this->operations;
	}

	/**
	 * @param AbstractOperation[] $operations
	 */
	public function setOperations(array $operations): void
	{
		$this->operations = $operations;
	}

	/**
	 * @param AbstractOperation $operation
	 */
	public function addOperation(AbstractOperation $operation): void
	{
		$this->operations[] = $operation;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return 'json';
	}

	/**
	 * @return AbstractOperation[]
	 */
	public function jsonSerialize()
	{
		return $this->operations;
	}
}
