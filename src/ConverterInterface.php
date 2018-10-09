<?php

namespace XTAIN\Patch;

interface ConverterInterface
{
	public function toPatch(PatchInterface $patch) : string;

	public function fromPatch(string $patch) : PatchInterface;

	/**
	 * @throws PatchFailedException If the patch operation has failed
	 */
	public function patch(string $document, PatchInterface $patch): string;

	public function getType() : string;
}
