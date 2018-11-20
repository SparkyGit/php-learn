<?php 

use \MyProject\Exceptions\CliException;
use \MyProject\Cli\AbstractCommand;

try
{
	unset($argv[0]);

	spl_autoload_register(function (string $className)
	{	
		require_once __DIR__ . '/../src/' . $className . '.php';
	});
	
	$className = '\\MyProject\\Cli\\' . array_shift($argv);
	if (!class_exists($className))
	{
		throw new CliException('Class: ' .$className. ' not found.');
	}

	$params = [];
	foreach ($argv as $argument)
	{
		preg_match('/^-(.+)=(.+)$/', $argument, $matches);
		if (!empty($matches))
		{
			$paramName = $matches[1];
			$paramValue = $matches[2];

			$params[$paramName] = $paramValue;
		}
	}

    $class = new $className($params);
    if (!$class instanceof AbstractCommand)
    {
        throw new CliException('Class: '.$className.' must be a child of AbstractCommand class!');
    }

	$class = new $className($params);
	$class->execute();
} catch (CliException $e)
{
	echo 'Error: ' .$e->getMessage();
}