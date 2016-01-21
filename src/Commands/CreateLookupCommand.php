<?php

namespace guiassemany\scGenerator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Finder\Finder;

class CreateLookupCommand extends Command
{
    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The finder instance.
     *
     * @var Finder
     */
    protected $finder;

    /**
     * The Table Name.
     *
     * @var table
     */
    protected $table;

  /**
   * Create a new command instance.
   *
   * @param Filesystem $files
   * @param Composer $composer
   */
  public function __construct(Filesystem $files, Finder $finder)
  {
      parent::__construct();
      $this->files = $files;
      $this->finder = $finder;
  }

    protected function configure()
    {
        $this
            ->setName('sc:lookup')
            ->setDescription('Generates a Lookup')
            ->addArgument(
                'table',
                InputArgument::REQUIRED,
                'Which table you want to query?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->table = $input->getArgument('table');

        $this->finder->files()->name('lookup.stub')->in(__DIR__."/../stubs/");

        foreach ($this->finder as $file) {
            //var_dump($file->getRealpath());
            $contents = $file->getContents();
            $this->replaceTableName($contents, 'binga');
            $this->files->dumpFile('lookup.php', $contents);
        }
    }

    /**
     * Replace the class name in the stub.
     *
     * @param  string $stub
     * @return $this
     */
    protected function replaceTableName(&$stub)
    {
        $stub = str_replace('{{table}}', $this->table, $stub);
        return $this;
    }
}
