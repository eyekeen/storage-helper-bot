<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;

use App\Converstations\RegisterConverstation;

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

$bot->onCommand('start', function(Nutgram $bot){
    $bot->sendMessage(
        text: 'Welcome!',
        reply_markup: InlineKeyboardMarkup::make()
            ->addRow(
                InlineKeyboardButton::make('A', callback_data: 'type:a'), 
                InlineKeyboardButton::make('B', callback_data: 'type:b')
            )
    );
});

$bot->onCallbackQueryData('type:a', function(Nutgram $bot){
    $bot->answerCallbackQuery(
        text: 'You selected A'
    );
});

$bot->onCallbackQueryData('type:b', function(Nutgram $bot){
    $bot->answerCallbackQuery(
        text: 'You selected B'
    );
});

$bot->onCommand('register', function(Nutgram $bot){
    RegisterConverstation::begin($bot);
});

$bot->run();