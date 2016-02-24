<?php

namespace Illuminate\Database\Console\Migrations;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;

class RefreshCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'migrate:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重置所有迁移和重新运行';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (! $this->confirmToProceed()) {
            return;
        }

        $database = $this->input->getOption('database');

        $force = $this->input->getOption('force');

        $path = $this->input->getOption('path');

        $this->call('migrate:reset', [
            '--database' => $database, '--force' => $force,
        ]);

        // The refresh command is essentially just a brief aggregate of a few other of
        // the migration commands and just provides a convenient wrapper to execute
        // them in succession. We'll also see if we need to re-seed the database.
        $this->call('migrate', [
            '--database' => $database,
            '--force' => $force,
            '--path' => $path,
        ]);

        if ($this->needsSeeding()) {
            $this->runSeeder($database);
        }
    }

    /**
     * Determine if the developer has requested database seeding.
     *
     * @return bool
     */
    protected function needsSeeding()
    {
        return $this->option('seed') || $this->option('seeder');
    }

    /**
     * Run the database seeder command.
     *
     * @param  string  $database
     * @return void
     */
    protected function runSeeder($database)
    {
        $class = $this->option('seeder') ?: 'DatabaseSeeder';

        $force = $this->input->getOption('force');

        $this->call('db:seed', [
            '--database' => $database, '--class' => $class, '--force' => $force,
        ]);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['database', null, InputOption::VALUE_OPTIONAL, '要使用的数据库连接。'],

            ['force', null, InputOption::VALUE_NONE, '在生产时力的操作运行。'],

            ['path', null, InputOption::VALUE_OPTIONAL, '执行迁移文件的路径。'],

            ['seed', null, InputOption::VALUE_NONE, '表明如果种子任务应该重新运行。'],

            ['seeder', null, InputOption::VALUE_OPTIONAL, '根播种机的类名。'],
        ];
    }
}
