<?php

namespace Illuminate\Queue\Console;

use Illuminate\Console\Command;

class RestartCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'queue:restart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重新启动队列工人守护进程在他们目前的工作';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->laravel['cache']->forever('illuminate:queue:restart', time());

        $this->info('广播队列重新启动信号。');
    }
}
