<?php

namespace Illuminate\Queue\Console;

use Carbon\Carbon;
use Illuminate\Queue\Worker;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\Job;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class WorkCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'queue:work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '处理队列的下一份工作';

    /**
     * The queue worker instance.
     *
     * @var \Illuminate\Queue\Worker
     */
    protected $worker;

    /**
     * Create a new queue listen command.
     *
     * @param  \Illuminate\Queue\Worker  $worker
     * @return void
     */
    public function __construct(Worker $worker)
    {
        parent::__construct();

        $this->worker = $worker;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if ($this->downForMaintenance() && ! $this->option('daemon')) {
            return $this->worker->sleep($this->option('sleep'));
        }

        $queue = $this->option('queue');

        $delay = $this->option('delay');

        // The memory limit is the amount of memory we will allow the script to occupy
        // before killing it and letting a process manager restart it for us, which
        // is to protect us against any memory leaks that will be in the scripts.
        $memory = $this->option('memory');

        $connection = $this->argument('connection');

        $response = $this->runWorker(
            $connection, $queue, $delay, $memory, $this->option('daemon')
        );

        // If a job was fired by the worker, we'll write the output out to the console
        // so that the developer can watch live while the queue runs in the console
        // window, which will also of get logged if stdout is logged out to disk.
        if (! is_null($response['job'])) {
            $this->writeOutput($response['job'], $response['failed']);
        }
    }

    /**
     * Run the worker instance.
     *
     * @param  string  $connection
     * @param  string  $queue
     * @param  int  $delay
     * @param  int  $memory
     * @param  bool  $daemon
     * @return array
     */
    protected function runWorker($connection, $queue, $delay, $memory, $daemon = false)
    {
        if ($daemon) {
            $this->worker->setCache($this->laravel['cache']->driver());

            $this->worker->setDaemonExceptionHandler(
                $this->laravel['Illuminate\Contracts\Debug\ExceptionHandler']
            );

            return $this->worker->daemon(
                $connection, $queue, $delay, $memory,
                $this->option('sleep'), $this->option('tries')
            );
        }

        return $this->worker->pop(
            $connection, $queue, $delay,
            $this->option('sleep'), $this->option('tries')
        );
    }

    /**
     * Write the status output for the queue worker.
     *
     * @param  \Illuminate\Contracts\Queue\Job  $job
     * @param  bool  $failed
     * @return void
     */
    protected function writeOutput(Job $job, $failed)
    {
        if ($failed) {
            $this->output->writeln('<error>['.Carbon::now()->format('Y-m-d H:i:s').'] 失败的:</error> '.$job->getName());
        } else {
            $this->output->writeln('<info>['.Carbon::now()->format('Y-m-d H:i:s').'] 加工过的:</info> '.$job->getName());
        }
    }

    /**
     * Determine if the worker should run in maintenance mode.
     *
     * @return bool
     */
    protected function downForMaintenance()
    {
        if ($this->option('force')) {
            return false;
        }

        return $this->laravel->isDownForMaintenance();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['connection', InputArgument::OPTIONAL, '连接的名字', null],
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
            ['queue', null, InputOption::VALUE_OPTIONAL, '监听的队列'],

            ['daemon', null, InputOption::VALUE_NONE, '工人在守护进程模式下运行'],

            ['delay', null, InputOption::VALUE_OPTIONAL, '推迟失败的工作的时间', 0],

            ['force', null, InputOption::VALUE_NONE, '强迫工人甚至在维护模式下运行'],

            ['memory', null, InputOption::VALUE_OPTIONAL, '兆字节的内存限制', 128],

            ['sleep', null, InputOption::VALUE_OPTIONAL, '的秒数没有可用的工作时睡觉', 3],

            ['tries', null, InputOption::VALUE_OPTIONAL, '多次尝试工作日志之前失败了', 0],
        ];
    }
}
