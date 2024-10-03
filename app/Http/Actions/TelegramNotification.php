<?php

namespace App\Http\Actions;

use Illuminate\Support\Facades\Http;

class TelegramNotification
{
    public function __invoke(string $message, string $chatId = null): void
    {
        $TOKEN             = config('telegram.telegram_bot_token');
        $telegramChannelId = $chatId ?? config('telegram.telegram_channel_id');
        $url               = 'https://api.telegram.org/bot' . $TOKEN . '/sendMessage';

        Http::get($url, [
            'chat_id' => $telegramChannelId,
            'text'    => $message,
        ]);
    }
}
