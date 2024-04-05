<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Conversations\Conversation;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use App\Services\UserService;

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

class MyConversation extends Conversation {

    private array $data = [];
    protected ?string $step = 'myStart';

    public function myStart(Nutgram $bot)
    {
        $bot->sendMessage('Enter login: ');
        $login = $bot->message()->text;
        $this->data['login'] = $login;
        $this->next('secondStep');
    }
    public function secondStep(Nutgram $bot)
    {
        $bot->sendMessage('Enter email: ');
        $email = $bot->message()->text;
        $this->data['email'] = $email;
        $this->next('thirdStep');
    }
    public function thirdStep(Nutgram $bot)
    {
        $bot->sendMessage('Enter password: ');
        $password = $bot->message()->text;
        $this->data['password'] = $password;
        $this->next('finalStep');
    }

    public function finalStep(Nutgram $bot)
    {
        $bot->sendMessage(json_encode($this->data));
        $this->end();
    }
}

$bot->onCommand('start', function(Nutgram $bot){
    $bot->sendMessage('hello');
});

$bot->onCommand('register', function(Nutgram $bot){
    MyConversation::begin($bot);
});

$bot->run();