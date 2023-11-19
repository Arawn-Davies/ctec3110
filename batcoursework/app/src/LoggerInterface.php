<?php

namespace Sessions;

interface LoggerInterface
{
    /**
     * Log all relevant activity
     *
     * @param $session_logger
     * @return mixed
     */
    public function setLogger($session_logger);

}