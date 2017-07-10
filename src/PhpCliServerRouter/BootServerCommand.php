<?php

namespace IainConnor\PhpCliServerRouter;

use Illuminate\Console\Command;

class BootServerCommand extends Command
{
    protected $signature = "php-cli-server:up {port=8000} {documentRoot=/public}";
    protected $description = "Boot the PHP built-in-cli server on the specified port.";

    public function handle()
    {
        $port = $this->argument('port');
        $documentRoot = realpath($this->laravel->basePath() . $this->argument('documentRoot'));
        $routerPath = realpath(__DIR__ . "/PhpCliServerRouter.php");

        $command = PHP_BINARY . " -S localhost:" . $port . " -t " . $documentRoot . " " . $routerPath;

        $this->line("<info>Development server started using:</info> $command");
        $this->line("http://localhost:" . $port);

        passthru($command);
    }
}
