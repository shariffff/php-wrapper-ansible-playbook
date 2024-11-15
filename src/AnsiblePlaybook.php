<?php

declare(strict_types=1);

namespace PHPPlay;

use InvalidArgumentException;

/**
 * Class Playbook
 */
abstract class AnsiblePlaybook
{
    use PlaybookOptionsTrait;
    protected string $playbook;
    protected string $inventory;

    public function __construct(private readonly string $ansiblePath = 'ansible-playbook') {}

    public function play(string $playbookPath)
    {
        $playbookPath = $this->base() .  $playbookPath;
        if (!file_exists($playbookPath) || !is_readable($playbookPath)) {
            throw new InvalidArgumentException("Playbook file does not exist on $playbookPath or is not readable");
        }

        if (pathinfo($playbookPath, PATHINFO_EXTENSION) !== "yml") {
            throw new InvalidArgumentException("Playbook file does not have a yml extension");
        }
        $this->playbook = $playbookPath;
        return $this;
    }
    // TODO set ansible.cfg path based on base

    /**
     * Path of the ansible base folder
     * @return string
     */
    abstract public function base();


    public function run()
    {
        return ['ansible-playbook', $this->playbook, ...$this->arguments()];
    }
}
