<?php

namespace Illuminate\Foundation\Console;

use Illuminate\Console\Command;

class EnvironmentCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '显示当前框架运行的环境';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->line('<info>当前应用程序环境:</info> <comment>'.$this->laravel['env'].'</comment>');
    }
}
