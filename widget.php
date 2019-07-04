<?php
header('Content-Type: image/png');

/* Require NodeQuery Libraries */
require_once("nodequery/Server.php");
require_once("nodequery/Client.php");
require_once("nodequery/Request.php");

/* Require Widget Classes */
require_once("class/WidgetConfig.php");
require_once("class/WidgetDatabase.php");
require_once("class/BaseTheme.php");

$config = new WidgetConfig("conf.json");
$database = new WidgetDatabase($config->get("database"));

/* Require Theme Class */
require_once("themes/" . $config->themeClass . ".php");

$identifier = md5($config->themeClass . ":" . $config->serverName);
$database->add($identifier, time());

$nextUpdate = $database->get($identifier);
$fileName = "data/" . $identifier . ".png";

if ($nextUpdate > time())
{
	readfile($fileName);
	return;
}

$nodequery = new NodeQuery\Client($config->get("api_key"));
$servers = $nodequery->servers();

$database->set($identifier, time() + $config->get("interval"));
$database->save();

// Set the environment variable for GD.
putenv('GDFONTPATH=' . realpath('.'));

foreach ($servers["data"][0] as $data)
{
	if ($data["name"] == $config->serverName)
	{
		$server = $data;
	}
}

$theme = new $config->themeClass();
$theme->render($server, $config, $database);
$theme->canvas->setImageFormat('png');
$theme->canvas->writeImage($fileName);

/* Clean the output buffer before rendering. */
ob_clean();

echo $theme->canvas;
?>