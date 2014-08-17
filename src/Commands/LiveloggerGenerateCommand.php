<?php  namespace Igormatkovic\Livelogger\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Config;

class LiveloggerGenerateCommand extends Command
{


    protected $name = "livelogger:generate";
    protected $description = "Generate a dashboard html to display data";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        Config::package('igormatkovic/laravel-livelogger', 'laravel-livelogger');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

        $pusher_api_key = Config::get('laravel-livelogger::pusher_api_key');

        $template = str_replace('{{ pusher_api_key }}', $pusher_api_key, file_get_contents(__DIR__.'/../Template/dashboard.html'));

        file_put_contents('public/livelogger.html', $template);

        $this->line('Generated to : public/dash.html');


    }



}
