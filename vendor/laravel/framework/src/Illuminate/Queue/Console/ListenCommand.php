<?php

namespace Illuminate\Queue\Console;

use Illuminate\Queue\Listener;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ListenCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'queue:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '监听一个给定队列';

    /**
     * The queue listener instance.
     *
     * @var \Illuminate\Queue\Listener
     */
    protected $listener;

    /**
     * Create a new queue listen command.
     *
     * @param  \Illuminate\Queue\Listener  $listener
     * @return void
     */
    public function __construct(Listener $listener)
    {
        parent::__construct();

        $this->listener = $listener;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->setListenerOptions();

        $delay = $this->input->getOption('delay');

        // The memory limit is the amount of memory we will allow the script to occupy
        // before killing it and letting a process manager restart it for us, which
        // is to protect us against any memory leaks that will be in the scripts.
        $memory = $this->input->getOption('memory');

        $connection = $this->input->getArgument('connection');

        $timeout = $this->input->getOption('timeout');

        // We need to get the right queue for the connection which is set in the queue
        // configuration file for the application. We will pull it based on the set
        // connection being run for the queue operation currently being executed.
        $queue = $this->getQueue($connection);

        $this->listener->listen(
            $connection, $queue, $delay, $memory, $timeout
        );
    }

    /**
     * Get the name of the queue connection to listen on.
     *
     * @param  string  $connection
     * @return string
     */
    protected function getQueue($connection)
    {
        if (is_null($connection)) {
            $connection = $this->laravel['config']['queue.default'];
        }

        $queue = $this->laravel['config']->get("queue.connections.{$connection}.queue", 'default');

        return $this->input->getOption('queue') ?: $queue;
    }

    /**
     * Set the options on the queue listener.
     *
     * @return void
     */
    protected function setListenerOptions()
    {
        $this->listener->setEnvironment($this->laravel->environment());

        $this->listener->setSleep($this->option('sleep'));

        $this->listener->setMaxTries($this->option('tries'));

        $this->listener->setOutputHandler(function ($type, $line) {
            $this->output->write($line);
        });
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['connection', InputArgument::OPTIONAL, '连接的名字'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['queue', null, InputOption::VALUE_OPTIONAL, '监听的队列', null],

            ['delay', null, InputOption::VALUE_OPTIONAL, '推迟失败的工作的时间', 0],

            ['memory', null, InputOption::VALUE_OPTIONAL, '兆字节的内存限制', 128],

            ['timeout', null, InputOption::VALUE_OPTIONAL, '秒之前可能会超时工作', 60],

            ['sleep', null, InputOption::VALUE_OPTIONAL, '秒前检查队列等待工作', 3],

            ['tries', null, InputOption::VALUE_OPTIONAL, '多次尝试工作日志之前失败了', 0],
        ];
    }
}
