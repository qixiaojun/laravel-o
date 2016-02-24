<?php

namespace Illuminate\Database\Console\Migrations;

use Illuminate\Database\Migrations\Migrator;
use Symfony\Component\Console\Input\InputOption;

class StatusCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'migrate:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '显示每个迁移的状态';

    /**
     * The migrator instance.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected $migrator;

    /**
     * Create a new migration rollback command instance.
     *
     * @param  \Illuminate\Database\Migrations\Migrator $migrator
     * @return \Illuminate\Database\Console\Migrations\StatusCommand
     */
    public function __construct(Migrator $migrator)
    {
        parent::__construct();

        $this->migrator = $migrator;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (! $this->migrator->repositoryExists()) {
            return $this->error('没有找到迁移。');
        }

        $this->migrator->setConnection($this->input->getOption('database'));

        if (! is_null($path = $this->input->getOption('path'))) {
            $path = $this->laravel->basePath().'/'.$path;
        } else {
            $path = $this->getMigrationPath();
        }

        $ran = $this->migrator->getRepository()->getRan();

        $migrations = [];

        foreach ($this->getAllMigrationFiles($path) as $migration) {
            $migrations[] = in_array($migration, $ran) ? ['<info>是</info>', $migration] : ['<fg=red>否</fg=red>', $migration];
        }

        if (count($migrations) > 0) {
            $this->table(['跑?', '迁移'], $migrations);
        } else {
            $this->error('没有找到迁移。');
        }
    }

    /**
     * Get all of the migration files.
     *
     * @param  string  $path
     * @return array
     */
    protected function getAllMigrationFiles($path)
    {
        return $this->migrator->getMigrationFiles($path);
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

            ['path', null, InputOption::VALUE_OPTIONAL, '使用迁移文件的路径。'],
        ];
    }
}
