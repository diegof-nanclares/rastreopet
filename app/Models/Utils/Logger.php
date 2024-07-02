<?php

namespace Models\Utils;

/**
 * Class Logger
 */
class Logger
{
    const ERROR_LOG_FILE = 'error.log';
    const INFO_LOG_FILE = 'info.log';
    const WARNING_LOG_FILE = 'warning.log';

    /**
     * @param $errorCode
     * @param $errorMessage
     */
    public function logError($errorCode, $errorMessage)
    {
        $this->logMessage(self::ERROR_LOG_FILE, 'Error', $errorCode, $errorMessage);
    }

    /**
     * @param $infoMessage
     */
    public function logInfo($infoMessage)
    {
        $this->logMessage(self::INFO_LOG_FILE, 'Info', null, $infoMessage);
    }

    /**
     * @param $warningMessage
     */
    public function logWarning($warningMessage)
    {
        $this->logMessage(self::WARNING_LOG_FILE, 'Warning', null, $warningMessage);
    }

    /**
     * @param $logFile
     * @param $level
     * @param $errorCode
     * @param $message
     */
    private function logMessage($logFile, $level, $errorCode, $message)
    {
        $logMessage = "[" . date('Y-m-d H:i:s') . "] [" . $level . "]";

        if ($errorCode !== null) {
            $logMessage .= " Error: " . $errorCode . " -";
        }

        $logMessage .= " " . $message . "\n";

        file_put_contents(__DIR__ . '/../../../var/log/' .  $logFile, $logMessage, FILE_APPEND);
    }
}
