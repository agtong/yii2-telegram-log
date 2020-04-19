# Yii2 Telegram Log Target

Yii2 [Telegram](https://telegram.org) log target that sends selected log messages to the specified telegram chats or channels.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require agtong/yii2-telegram-log-target
```

or add

```
"agtong/yii2-telegram-log-target": "*"
```

to the require section of your `composer.json` file.

## Usage

Add this log target to the `components` section in your configuration.

```
'components' => [
    'log' => [
        'targets' => [
            [
                'class' => 'agtong\yii2\log\TelegramTarget',
                'botToken' => '123456:abcde',
                'chatId' => '123456',
                'levels' => ['error'],
                'logVars' => [],
            ],
        ],
    ],
],
```

You can choose to disable this target by default,

```
'components' => [
    'log' => [
        'targets' => [
            'telegramTarget => [ // Name this target
                'class' => 'agtong\yii2\log\TelegramTarget',
                'botToken' => '123456:abcde',
                'chatId' => '123456',
                'enabled' => false, // Disabled by default
                'levels' => ['error'],
                'logVars' => [],
            ],
        ],
    ],
],
```

and enable it when required.

```
Yii::$app->log->targets['telegramTarget']->enabled = true;
Yii::error('Hello World!');
```
