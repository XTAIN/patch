<?php

namespace XTAIN\Patch\JSON;

use XTAIN\Patch\ConverterInterface;
use XTAIN\Patch\JSON\Operation\AbstractOperation;
use XTAIN\Patch\JSON\Operation\Add;
use XTAIN\Patch\JSON\Operation\Copy;
use XTAIN\Patch\JSON\Operation\Move;
use XTAIN\Patch\JSON\Operation\Remove;
use XTAIN\Patch\JSON\Operation\Replace;
use XTAIN\Patch\JSON\Operation\Test;
use XTAIN\Patch\PatchFailedException;
use XTAIN\Patch\PatchInterface;
use Rs\Json\Patch as JsonPatch;

final class Converter implements ConverterInterface
{
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return 'json';
	}

	/**
	 * @param PatchInterface $patch
	 *
	 * @throws \InvalidArgumentException If $patch is not an instance of \XTAIN\Patch\JSON\Patch
	 * @return string
	 */
	public function toPatch(PatchInterface $patch): string
	{
		if (!($patch instanceof Patch)) {
			throw new \InvalidArgumentException(
				sprintf('$path not an instance of %s', Patch::class)
			);
		}

		return json_encode($patch);
	}

	/**
	 * @param array $item
	 *
	 * @return AbstractOperation
	 */
	private function toOperation(array $item) : AbstractOperation
	{
		$operation = null;
		$path = new Pointer($item["path"]);
		$value = null;
		$from = null;
		if (isset($item["value"])) {
			$value = new Value($item["value"]);
		}
		if (isset($item["from"])) {
			$from = new Pointer($item["from"]);
		}
		switch ($item["op"]) {
			case 'test':
				$operation = new Test($path, $value);
				break;
			case 'remove':
				$operation = new Remove($path);
				break;
			case 'add':
				$operation = new Add($path, $value);
				break;
			case 'replace':
				$operation = new Replace($path, $value);
				break;
			case 'move':
				$operation = new Move($path, $from);
				break;
			case 'copy':
				$operation = new Copy($path, $from);
				break;
			default:
				throw new InvalidOperationException();
		}

		return $operation;
	}

	/**
	 * @param string $patch
	 *
	 * @return PatchInterface
	 */
	public function fromPatch(string $patch): PatchInterface
	{
		return $this->fromArray(
			\json_decode($patch, true)
		);
	}

	/**
	 * @param array $items
	 *
	 * @throws InvalidOperationException
	 * @return PatchInterface
	 */
	public function fromArray(array $items): PatchInterface
	{
		$patch = new Patch();
		foreach ($items as $item) {
			$patch->addOperation(
				$this->toOperation(
					$item
				)
			);
		}

		return $patch;
	}

	/**
	 * @param string         $document
	 * @param PatchInterface $patch
	 *
	 * @throws PatchFailedException If the patch operation has failed
	 * @return string
	 */
	public function patch(string $document, PatchInterface $patch): string
	{
		try {
			$jsonPatch = new JsonPatch($document, $this->toPatch($patch));
			return $jsonPatch->apply();
		} catch (JsonPatch\InvalidPatchDocumentJsonException $e) {
		} catch (JsonPatch\InvalidTargetDocumentJsonException $e) {
		} catch (JsonPatch\FailedTestException $e) {
		} catch (JsonPatch\InvalidOperationException $e) {
		}

		throw new PatchFailedException(
			'Could not patch document',
			0,
			$e
		);
	}
}
