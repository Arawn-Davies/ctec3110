<?php
// add comments to log files
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
require 'vendor/autoload.php';
$log = new Logger ("logger");
$logs_file_path = '/p3t/phpappfolder/logs/';
$logs_file_name_warning = 'tester_warning.log';
$logs_file_warning = $logs_file_path .
$logs_file_name_warning;
$logs_file_name_notice = 'tester_notice.log';
$logs_file_notice= $logs_file_path . $logs_file_name_notice;
// create a log channel
$log->pushHandler(new StreamHandler($logs_file_warning,
Logger::WARNING));
$log->pushHandler(new StreamHandler($logs_file_notice,
Logger::NOTICE));
echo 'Adding entries to the log file';
$log->notice('Testing the Monolog library');
$log->warning('Testing warnings');