<?php

namespace XTAIN\Patch\JSON;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;

class SerializationHandler implements SubscribingHandlerInterface
{
	/**
	 * @var Converter
	 */
	protected $converter;

	/**
	 * SerializationHandler constructor.
	 */
	public function __construct(Converter $converter)
	{
		$this->converter = $converter;
	}

	public static function getSubscribingMethods()
	{
		return [
			[
				'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
				'format' => 'json',
				'type' => Patch::class,
				'method' => 'serializeToJson',
			],
			[
				'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
				'format' => 'json',
				'type' => Patch::class,
				'method' => 'deserializeFromJson',
			],
		];
	}

	public function serializeToJson(
		JsonSerializationVisitor $visitor,
		$value,
		array $type,
		Context $context
	) {
		return $this->converter->toPatch($value);
	}

	public function deserializeFromJson(
		JsonDeserializationVisitor $visitor,
		$value,
		array $type,
		Context $context
	) {
		return $this->converter->fromArray($value);
	}
}