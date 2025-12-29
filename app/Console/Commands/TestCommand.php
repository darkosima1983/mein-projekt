<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

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
        //$response = Http::get('https://jsonplaceholder.typicode.com/users/1');
        //dd($response->json());
        $response = Http::post('https://jsonplaceholder.typicode.com/posts', [
            'title' => 'foo',
            'body' => 'bar',
            'userId' => 1,
        ]);
        dd($response->json());
    }
}
