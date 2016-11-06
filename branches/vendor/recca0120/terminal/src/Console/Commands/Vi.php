<?php

namespace Recca0120\Terminal\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class Vi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vi {path} {--text=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vi Editor';

    /**
     * handle.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {
        $path = $this->argument('path');
        $text = $this->option('text');
        $root = $this->laravel->basePath();
        $path = realpath($root.'/'.$path);
        if (is_null($text) === false) {
            $filesystem->put($path, $text);
        } else {
            $this->line($filesystem->get($path));
        }
    }
}
