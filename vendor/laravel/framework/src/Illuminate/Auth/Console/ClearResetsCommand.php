<?php

namespace Illuminate\Auth\Console;

use Illuminate\Console\Command;

class ClearResetsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:clear-resets {name? : 代理的名称密码}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '刷新过期密码重置令牌';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->laravel['auth.password']->broker($this->argument('name'))->getRepository()->deleteExpired();

        $this->info('重置令牌到期了!');
    }
}
