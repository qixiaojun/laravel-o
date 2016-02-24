<?php

namespace Illuminate\Queue\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class ForgetFailedCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'queue:forget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '删除队列失败的工作';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if ($this->laravel['queue.failer']->forget($this->argument('id'))) {
            $this->info('Failed job deleted successfully!');
        } else {
            $this->error('没有失败的工作匹配给定的ID。');
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['id', InputArgument::REQUIRED, '失败的工作的ID'],
        ];
    }
}
