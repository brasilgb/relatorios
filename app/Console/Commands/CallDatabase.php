<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CallDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CallDatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'nsere dados no banco mysql.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //return Command::SUCCESS;
        $controller = app()->make('App\Http\Controllers\HomeController');
        app()->call([$controller, 'insertData']);
        return;
    }
}
