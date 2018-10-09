<?php

namespace XTAIN\Patch\JSON;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\XmlDeserializationVisitor;
use JMS\Serializer\XmlSerializationVisitor;
use JMS\Serializer\Annotation as Serializer;

trait ValueTrait
{
	/**
	 * @Serializer\HandlerCallback(format="xml", direction="serialization")
	 */
	public function serializeToXml(
		XmlSerializationVisitor $visitor,
		$value,
		SerializationContext $context
	) {
		/** @var \DOMDocument $document */
		$document = $visitor->getDocument();

		if ($document === null) {
			$visitor->setDefaultRootName(self::PROPERTY);
			$visitor->document = $visitor->createDocument();
			$visitor->document->documentElement->setAttribute('format', 'json');
			$visitor->document->documentElement->nodeValue = json_encode($this->{self::PROPERTY});
		} else {
			$element = $document->createElement(self::PROPERTY, json_encode($this->{self::PROPERTY}));
			$element->setAttribute('format', 'json');

			return $element;
		}
	}

	/**
	 * @Serializer\HandlerCallback(format="json", direction="serialization")
	 */
	public function serializeToJson(
		JsonSerializationVisitor $visitor,
		$value,
		SerializationContext $context
	) {
		if ($visitor->getRoot() === null) {
			$visitor->setRoot($this->{self::PROPERTY});
		} else {
			return $this->{self::PROPERTY};
		}
	}

	/**
	 * @Serializer\HandlerCallback(format="xml", direction="deserialization")
	 */
	public function deserializeFromXml(
		XmlDeserializationVisitor $visitor,
		$value,
		DeserializationContext  $context
	) {
		if (!($value instanceof \SimpleXMLElement)) {
			throw new \RuntimeException(sprintf(
				'expected object of type %s, type %s give',
				'\SimpleXMLElement',
				get_class($value)
			));
		}

		$value = (string) $value;
		$this->{self::PROPERTY} = json_decode($value);
	}

	/**
	 * @Serializer\HandlerCallback(format="json", direction="deserialization")
	 */
	public function deserializeFromJson(
		JsonDeserializationVisitor $visitor,
		$value,
		DeserializationContext $context
	) {
		$this->{self::PROPERTY} = $value;
	}
}
