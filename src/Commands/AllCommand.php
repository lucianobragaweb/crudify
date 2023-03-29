<?php
namespace FaceDigital\FaceGen\Commands;

use Illuminate\Console\Command;
use FaceDigital\FaceGen\Commands\Traits\TableSchema;

class AllCommand extends Command
{
    use TableSchema;

    protected $signature = 'facegen:all
    { name : resource name(singular) }
    {--schema= : Schema options}
    {--except= : O que não quer que não seja gerado (Optional)}
    {--timestamp= : Timestamp ex: 2023_14_16_140039 (Optional)}';

    protected $description = 'Executa todos os comandos facegen';

    public function handle(): void
    {
        $this->line("Start Generating...");

        // Se não passar o Schema
        if (!$this->option('schema')) {
            //verifica se a tabela existe
            if (!$this->hasTable()) {
                $this->warn('A tabela '.$this->argument('name').' não existe no banco de dados');
                return;
            }
        }

        $this->generate();

        $this->line("All done!!");
    }

    protected function generate()
    {
        if (!$this->option('schema')) {
            $schemaOption = $this->getTableSchema($this->argument('name'));
        } else {
            $schemaOption = $this->option('schema');
        }

        $tableName = $this->argument('name');
        $timestamp = $this->option('timestamp') ? $this->option('timestamp') : null;
        $except = $this->option('except');

        if (!$except || !in_array('migration', $except)) {
            $this->callMigration($tableName, $schemaOption, $timestamp);
        }

        if (!$except || !in_array('factory', $except)) {
            $this->callFactory($tableName, $schemaOption);
        }

        if (!$except || !in_array('model', $except)) {
            $this->callModel($tableName, $schemaOption);
        }

        if (!$except || !in_array('controller', $except)) {
            $this->callController($tableName, $schemaOption);
        }

        if (!$except || !in_array('views', $except)) {
            $this->callViews($tableName, $schemaOption);
        }
    }

    private function callMigration(string $tableName, string $schemaOption, string $timestamp): void
    {
        $this->call("facegen:migration", ['name' => $tableName, '--schema' => $schemaOption, '--timestamp' => $timestamp]);
        $this->line("Migration Created!");
    }

    private function callFactory(string $tableName, string $schemaOption): void
    {
        $this->call("facegen:factory", ['name' => $tableName, '--schema' => $schemaOption]);
        $this->line("Factory Created!");
    }

    private function callModel(string $tableName, string $schemaOption): void
    {
        $this->call("facegen:model", ['name' => $tableName, '--schema' => $schemaOption]);
        $this->line("Model Created!");
    }

    private function callController(string $tableName, string $schemaOption): void
    {
        $this->call("facegen:controller", ['name' => $tableName, '--schema' => $schemaOption]);
        $this->line("Controller Created!");
    }

    private function callViews(string $tableName, string $schemaOption): void
    {
        $this->call("facegen:index", ['name' => $tableName, '--schema' => $schemaOption]);
        $this->line("View index Created!");

        $this->call("facegen:create", ['name' => $tableName, '--schema' => $schemaOption]);
        $this->line("View create Created!");

        $this->call("facegen:edit", ['name' => $tableName, '--schema' => $schemaOption]);
        $this->line("View edit Created!");

        $this->call("facegen:show", ['name' => $tableName, '--schema' => $schemaOption]);
        $this->line("View show Created!");
    }
}
