<?php

/**
 * Class{
fullfilable: true
components: [
{
name: 'PHP',
value: '7.2.9',
}
]
}
 */
class CheckResponse {

	/**
	 * Is the request fullfillable?
	 *
	 * @var bool
	 */
	public $fullfillable;

	/**
	 * Associative array
	 *
	 * @var array
	 */
	public $components = [];

	public function __construct()
	{
		// ?!
	}

	/**
	 * Add a component to the response
	 *
	 * @param $name
	 * @param $value
	 */
	public function addComponent($name, $value)
	{
		$this->components[] = ['name' => $name, 'value' => $value];
	}

	/**
	 * @return bool
	 */
	public function isFullfillable()
	{
		return $this->fullfillable;
	}

	/**
	 * @param bool $fullfillable
	 */
	public function setFullfillable($fullfillable)
	{
		$this->fullfillable = $fullfillable;
	}



	/**
	 * @return array
	 */
	public function getComponents()
	{
		return $this->components;
	}

	/**
	 * @param array $components
	 */
	public function setComponents($components)
	{
		$this->components = $components;
	}
}

