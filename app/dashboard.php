<?php
// MudPi Setup Page to help new users with first time configurations
// such as connecting to their home network and installing any other
// depencies based on options picked during setup.
require 'bootstrap.php';

begin_session();
handle_csrf();

set_csrf_token();

setcookie("setup_completed", date("d-m-Y H:i:s"), time() + (3600 * 12)); // expires in 12hrs

$readingSuffixes = [
	"humidity" => "%",
	"temperature" => "°",
	"soil" => "%",
	"moisture" => "%",
	"float" => "",
	"rain" => "%",
	"altitude" => '\'',
	"pressure" => 'hPa',
	"gas" => 'Ω'
];

//Connecting to Redis server on localhost 
$redis = new Redis(); 
$redis->connect(MUDPI_REDIS_HOST, MUDPI_REDIS_PORT); 

$started_at = strtotime($redis->get("started_at"));

// Get the stored keys and print it 
$redis_keys = $redis->keys("*"); 

$config = json_decode(file_get_contents(MUDPI_PATH_CORE."/mudpi.config"));

$sensor_workers = array_merge(array_filter($config->workers, function($v) {
	return strcasecmp($v->type, "sensor") == 0 || strcasecmp($v->type, "i2c") == 0;
}));

$sensors = [];

foreach($sensor_workers as $worker) {
	array_push($sensors, ...$worker->sensors);
}

foreach($sensors as $sensor) {
	$sensor->key = slug($sensor->name);
	$sensor->value = parseReading($sensor->type, $redis->get($sensor->key));
}


include 'templates/dashboard.php';

?>