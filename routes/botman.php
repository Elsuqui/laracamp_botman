<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('hola|hi', function ($bot) {
    $bot->reply('Hola, bienvenido al laracamp, si deseas conversar escribe: operaciones! hora: '.\Carbon\Carbon::now()->toDateTimeString());
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('operaciones', BotManController::class.'@startOperations');
