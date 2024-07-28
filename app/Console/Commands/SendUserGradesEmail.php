<?php

namespace App\Console\Commands;

use App\Jobs\SendMessageEmailJob;
use Illuminate\Console\Command;

class SendUserGradesEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-user-grades-email {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SendMessageEmailJob::dispatch($this->argument('user_id'))
            ->onConnection('database')
            ->onQueue('emails');
    }
}
