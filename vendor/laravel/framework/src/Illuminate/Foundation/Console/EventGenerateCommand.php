<?php

namespace Illuminate\Foundation\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;

class EventGenerateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'event:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成基于登记失踪事件和监听器';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $provider = $this->laravel->getProvider(
            'Illuminate\Foundation\Support\Providers\EventServiceProvider'
        );

        foreach ($provider->listens() as $event => $listeners) {
            if (! Str::contains($event, '\\')) {
                continue;
            }

            $this->callSilent('make:event', ['name' => $event]);

            foreach ($listeners as $listener) {
                $listener = preg_replace('/@.+$/', '', $listener);

                $this->callSilent('make:listener', ['name' => $listener, '--event' => $event]);
            }
        }

        $this->info('事件和监听器生成成功!');
    }
}
