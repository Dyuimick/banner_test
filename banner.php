<?php

require_once 'vendor/autoload.php';

use App\Tracker;
use App\BannerDTO;
use App\DatabaseFactory;

$config = require 'config/config.php';

$ipAddress = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$pageUrl = $_SERVER['HTTP_REFERER'] ?? $config['default_referer'];
$viewDate = date("Y-m-d H:i:s");


$db = DatabaseFactory::create($config);

$bannerDTO = new BannerDTO($db,$ipAddress, $userAgent, $pageUrl, $viewDate);
$tracker = new Tracker($db);
$tracker->save($bannerDTO);

// Output image data
header('Content-Type: image/png');
echo file_get_contents('img/banner.jpg');