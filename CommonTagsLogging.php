<?php

declare(strict_types=1);

namespace app\traits;

use Yii;

/**
 * Trait CommonTagsLogging
 *
 * @author Timofiy Prisyazhnyuk
 * @version 1.0
 */
trait CommonTagsLogging
{
    /**
     * For gets log tags.
     *
     * @return array
     */
    abstract protected function getLogTags(): array;

    /**
     * Logs info message.
     *
     * @param string $message
     *
     * @return void
     */
    protected function logInfo(string $message): void
    {
        Yii::$app->logger->info($message, ['tags' => $this->getLogTags()]);
    }

    /**
     * Logs warning message.
     *
     * @param string $message
     *
     * @return void
     */
    protected function logWarning(string $message): void
    {
        Yii::$app->logger->warning($message, ['tags' => $this->getLogTags()]);
    }

    /**
     * Logs error message.
     *
     * @param string $message
     */
    protected function logError(string $message): void
    {
        Yii::$app->logger->error($message, ['tags' => $this->getLogTags()]);
    }

    /**
     * Prepare log message.
     *
     * @param \Throwable $e
     * @param null|string $firstMessage
     *
     * @return string
     */
    protected function prepareLogMessage(\Throwable $e, ?string $firstMessage = null): string
    {
        $message = [];

        if ($firstMessage !== null) {
            $message[] = $firstMessage;
        }

        $message[] = 'Message: ' . $e->getMessage();
        $message[] = 'File: ' . $e->getFile();
        $message[] = 'Line: ' . $e->getLine();
        $message[] = 'Trace: ' . $e->getTraceAsString();

        return implode("\n", $message);
    }
}
