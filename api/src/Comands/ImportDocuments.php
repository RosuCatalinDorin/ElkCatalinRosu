<?php

namespace App\Comands;

use App\Services\TelegramService;
use JsonMachine\Items;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Creates a new user.',
    aliases: ['app:add-user'],
    hidden: false
)]
class ImportDocuments extends Command
{
    private TelegramService $service;

    public function __construct(TelegramService $service)
    {
        $this->service = $service;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        ini_set('memory_limit','-1');
        ini_set('max_execution_time','-1');
        ini_set('max_input_time','-1');
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            '============',
            'Start',
            '',
        ]);
      //  dd(__DIR__);
        $rows = Items::fromFile('./bigJson/JsonFILECONVERT.json');
        $output->writeln([
            '============',
            'Done red file',
            '',
        ]);

        $this->service->insertMessagesToElk($rows);

        // the value returned by someMethod() can be an iterator (https://php.net/iterator)
        // that generates and returns the messages with the 'yield' PHP keyword
  //      $output->writeln($this->someMethod());
//
        // outputs a message followed by a "\n"
        $output->writeln('Whoa!');

        return Command::SUCCESS;
    }
}