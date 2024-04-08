<?php

namespace App\Converstations;

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Conversations\Conversation;

use App\Contract\UserRepositoryInterface;
use App\Repositories\UserRepository;

class RegisterConverstation extends Conversation
{
    protected array $data;
    protected ?string $step = 'myStart';

    public function myStart(Nutgram $bot)
    {
        $bot->sendMessage('Enter login: ');
        $this->next('secondStep');
    }
    public function secondStep(Nutgram $bot)
    {
        $this->data['login'] = $bot->message()->getText();
        $bot->sendMessage('Enter email: ');
        $this->next('thirdStep');
    }
    public function thirdStep(Nutgram $bot)
    {
        $this->data['email'] = $bot->message()->getText();
        $bot->sendMessage('Enter password: ');
        $this->next('finalStep');
    }

    public function finalStep(Nutgram $bot)
    {
        $this->data['password'] = $bot->message()->getText();

        $this->data['type'] = 'V';

        $repository = new UserRepository();

        $bot->sendMessage($repository->createUser($this->data));
        $this->end();
    }
}
