<?php
namespace app\Helpers\ConfigWriter;

use Illuminate\Config\LoaderInterface;
use Illuminate\Config\Repository as RepositoryBase;

/*
https://github.com/daftspunk/laravel-config-writer
author: daftspunk ( Samuel Georges )
license: available on github -- issue #6 put's under MIT
*/

class Repository extends RepositoryBase
{
	/**
	 * The config rewriter object.
	 *
	 * @var string
	 */
	protected $writer;

	/**
	 * Create a new configuration repository.
	 *
	 * @param  \Illuminate\Config\LoaderInterface  $loader
	 * @param  string  $environment
	 * @return void
	 */
	public function __construct(LoaderInterface $loader, $writer, $environment)
	{
		$this->writer = $writer;
		parent::__construct($loader, $environment);
	}

	/**
	 * Write a given configuration value to file.
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	public function write($key, $value)
	{
		list($namespace, $group, $item) = $this->parseKey($key);
		$result = $this->writer->write($item, $value, $this->environment, $group, $namespace);

		if(!$result) throw new \Exception('File could not be written to');

		$this->set($key, $value);
	}


}
