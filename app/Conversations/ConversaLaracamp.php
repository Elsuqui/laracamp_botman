<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class ConversaLaracamp extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askOperations();
    }

    public function askOperations()
    {
        $question = Question::create("Que concepto deseas recordar?")
            ->fallback('no se pudo responder la pregunta')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('suma')->value('S'),
                Button::create('resta')->value('R'),
                Button::create('multiplicacion')->value('M'),
                Button::create('division')->value('D'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()){
                    case 'S':
                        $response='La suma o adición es la operación matemática que resulta al reunir en una sola varias cantidades. Las números que se suman se llaman sumandos y el resultado suma o total.';
                        break;
                    case 'R':
                        $response='La resta o la sustracción es una operación de aritmética que se representa con el signo (–), representa la operación de eliminación de objetos de una colección';
                        break;
                    case 'M':
                        $response='Operación aritmética que consiste en calcular el resultado (producto) de sumar un mismo número (multiplicando) tantas veces como indica otro número (multiplicador)';
                        break;
                    case 'D':
                        $response='La división es una operación matemática o aritmética que consiste en averiguar cuántas veces un número (el divisor) está contenido en otro número (el dividendo).';
                        break;
                    default:
                        $response='Respuesta no encontrada';
                        break;
                };
                $this->say($response);

            }
        });
    }
}
