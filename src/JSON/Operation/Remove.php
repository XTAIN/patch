<?php

namespace XTAIN\Patch\JSON\Operation;

final class Remove extends AbstractOperation
{
	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return array_merge([
			"op" => "remove"
		], parent::jsonSerialize());
	}
}