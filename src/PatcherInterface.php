<?php

namespace XTAIN\Patch;

interface PatcherInterface
{
	/**
	 * @param PatchInterface $patch
	 *
	 * @throws UnsupportedFormatException If converter format is not available
	 * @return string
	 */
	public function toPatch(PatchInterface $patch) : string;

	/**
	 * @param string $patch
	 * @param string $format
	 *
	 * @throws UnsupportedFormatException If converter format is not available
	 * @return PatchInterface
	 */
	public function fromPatch(string $patch, string $format) : PatchInterface;

	/**
	 * @param string $document
	 * @param PatchInterface $patch
	 *
	 * @throws UnsupportedFormatException If converter format is not available
	 * @throws PatchFailedException       If the patch operation has failed
	 * @return string
	 */
	public function patch(string $document, PatchInterface $patch) : string;
}
