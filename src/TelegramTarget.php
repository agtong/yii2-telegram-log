<?php

namespace agtong\yii2\log;

use agtong\yii2\components\TelegramBot;
use yii\base\InvalidConfigException;
use yii\log\Target;

/**
 * TelegramTarget is a log target that sends messages to Telegram.
 *
 * Here's an example config setup. Both botToken and chatId has to be defined.
 *
 * 'components' => [
 *     'log' => [
 *         'targets' => [
 *             [
 *                 'class' => 'agtong\yii2\log\TelegramTarget',
 *                 'botToken' => '123456:abcde',
 *                 'chatId' => '123456',
 *                 'levels' => ['error'],
 *                 'logVars' => [],
 *             ],
 *         ],
 *     ],
 * ],
 *
 * @author agtong <agtongatgithub@gmail.com>
 */
class TelegramTarget extends Target
{
    /**
     * [Telegram bot token](https://core.telegram.org/bots#botfather)
     * @var string
     */
    public $botToken;

    /**
     * Destination chat id or channel username
     * @var int|string
     */
    public $chatId;

    /**
     * Check required properties
     */
    public function init()
    {
        parent::init();

        foreach (['botToken', 'chatId'] as $property) {
            if ($this->$property === null) {
                throw new InvalidConfigException(self::className() . "::\$$property property must be set");
            }
        }
    }

    /**
     * Exports log message only to a specific destination.
     */
    public function export()
    {
        $bot = new TelegramBot(['token' => $this->botToken]);

        foreach ($this->messages as $message) {
            $bot->sendMessage($this->chatId, $message[0], 'Markdown');
        }
    }
}
