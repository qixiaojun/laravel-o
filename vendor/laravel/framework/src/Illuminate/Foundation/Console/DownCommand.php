<?php

namespace Illuminate\Foundation\Console;

use Illuminate\Console\Command;

class DownCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'down';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '把应用程序进入维护模式';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        touch($this->laravel->storagePath().'/framework/down');

        $this->comment('应用程序现在已经在维护模式。');
    }
}
