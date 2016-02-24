<?php

namespace Illuminate\Foundation\Console;

use Illuminate\Console\Command;

class UpCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '把应用程序退出维护模式';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        @unlink($this->laravel->storagePath().'/framework/down');

        $this->info('应用程序现在在线了。');
    }
}
