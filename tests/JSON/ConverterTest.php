<?php

namespace Tests\XTAIN\Patch\JSON;

use PHPUnit\Framework\TestCase;
use XTAIN\Patch\JSON\Converter;
use XTAIN\Patch\JSON\Operation\Replace;
use XTAIN\Patch\JSON\Patch;
use XTAIN\Patch\JSON\Pointer;
use XTAIN\Patch\JSON\Value;
use XTAIN\Patch\Patcher;

class ConverterTest extends TestCase
{
	/**
	 * @var Patcher
	 */
	protected $patcher;

	public function setUp()
	{
		$this->patcher = new Patcher();
		$this->patcher->setConverter(new Converter());
	}

	public function testJsonToPatch()
	{
		$patch = new Patch();
		$op = new Replace(new Pointer("/bla/test"), new Value(1));
		$patch->addOperation($op);

		$this->assertEquals(
			'[{"op":"replace","value":1,"path":"\/bla\/test"}]',
			$this->patcher->toPatch($patch)
		);
	}

	public function testJsonSimplePatch()
	{
		$patch = new Patch();
		$op = new Replace(new Pointer("/bla/test"), new Value(1));
		$patch->addOperation($op);

		$finalJson = $this->patcher->patch('{"test":"foo","bla":{"test":"abc"}}', $patch);
		$this->assertEquals('{"test":"foo","bla":{"test":1}}', $finalJson);
	}

	/**
	 * @expectedException \XTAIN\Patch\PatchFailedException
	 */
	public function testJsonFailedPatch()
	{
		$patch = new Patch();
		$op = new Replace(new Pointer("/bla/test"), new Value(1));
		$patch->addOperation($op);

		$this->patcher->patch('{"test":"fo,"bla":["test","abc"]}', $patch);
	}
}
