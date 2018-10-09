<?php

namespace XTAIN\Patch;

final class Patcher implements PatcherInterface
{
	/**
	 * @var ConverterInterface[]
	 */
	private $converters = [];

	/**
	 * @param ConverterInterface $converter
	 */
	public function setConverter(ConverterInterface $converter) : void
	{
		$this->converters[$converter->getType()] = $converter;
	}

	/**
	 * @param string $format
	 *
	 * @return ConverterInterface
	 */
	private function getConverter(string $format)
	{
		if (!isset($this->converters[$format])) {
			throw new UnsupportedFormatException(
				sprintf("Converter for format %s not available", $format)
			);
		}

		return $this->converters[$format];
	}

	/**
	 * @param PatchInterface $patch
	 *
	 * @throws UnsupportedFormatException If converter format is not available
	 * @return string
	 */
	public function toPatch(PatchInterface $patch) : string
	{
		return $this->getConverter($patch->getType())->toPatch($patch);
	}

	/**
	 * @param string $patch
	 * @param string $format
	 *
	 * @throws UnsupportedFormatException If converter format is not available
	 * @return PatchInterface
	 */
	public function fromPatch(string $patch, string $format) : PatchInterface
	{
		return $this->getConverter($format)->fromPatch($patch);
	}

	/**
	 * @param string $document
	 * @param PatchInterface $patch
	 *
	 * @throws UnsupportedFormatException If converter format is not available
	 * @throws PatchFailedException       If the patch operation has failed
	 * @return string
	 */
	public function patch(string $document, PatchInterface $patch) : string
	{
		return $this->getConverter($patch->getType())->patch($document, $patch);
	}
}
