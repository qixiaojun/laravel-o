<?php

namespace Illuminate\Queue\Console;

use Illuminate\Console\Command;

class FlushFailedCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'queue:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '冲洗所有失败的队列的工作';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->laravel['queue.failer']->flush();

        $this->info('所有失败的工作成功删除!');
    }
}
