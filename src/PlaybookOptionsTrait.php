<?php

declare(strict_types=1);

namespace PHPPlay;

trait PlaybookOptionsTrait
{
    protected $options = [];
    protected $arguments = [];

    /**
     * Add a flag option.
     *
     * @param string $option The option flag to add.
     */
    protected function addOption(string $option): self
    {
        $this->options[] = $option;
        return $this;
    }

    /**
     * Add a key-value argument.
     *
     * @param string $argument The argument key.
     * @param mixed  $value    The argument value.
     */
    protected function addArgument(string $argument, $value): self
    {
        $this->arguments[$argument] = $value;
        return $this;
    }

    public function listTasks(): self
    {
        return $this->addOption('--list-tasks');
    }

    public function skipTags(string $skipTags): self
    {
        return $this->addArgument('--skip-tags', $skipTags);
    }


    public function privateKeyFile(string $privateKeyFile): self
    {
        return $this->addArgument('--private-key', $privateKeyFile);
    }

    public function scpExtraArgs(string $scpExtraArgs): self
    {
        return $this->addArgument('--scp-extra-args', $scpExtraArgs);
    }

    public function sftpExtraArgs(string $sftpExtraArgs): self
    {
        return $this->addArgument('--sftp-extra-args', $sftpExtraArgs);
    }

    public function sshCommonArgs(string $sshCommonArgs): self
    {
        return $this->addArgument('--ssh-common-args', $sshCommonArgs);
    }

    public function sshExtraArgs(string $sshExtraArgs): self
    {
        return $this->addArgument('--ssh-extra-args', $sshExtraArgs);
    }

    public function timeout(int $timeout): self
    {
        return $this->addArgument('--timeout', (string)$timeout);
    }

    public function connection(string $connection): self
    {
        return $this->addArgument('--connection', $connection);
    }

    public function remoteUser(string $remoteUser): self
    {
        return $this->addArgument('--user', $remoteUser);
    }

    public function becomeMethod(string $becomeMethod): self
    {
        return $this->addArgument('--become-method', $becomeMethod);
    }

    public function becomeUser(string $becomeUser): self
    {
        return $this->addArgument('--become-user', $becomeUser);
    }

    public function become(): self
    {
        return $this->addOption('--become');
    }

    public function becomePasswordFile(string $becomePasswordFile): self
    {
        return $this->addArgument('--become-password-file', $becomePasswordFile);
    }

    public function askBecomePass(): self
    {
        return $this->addOption('--ask-become-pass');
    }

    public function connectionPasswordFile(string $connectionPasswordFile): self
    {
        return $this->addArgument('--connection-password-file', $connectionPasswordFile);
    }

    public function flushCache(): self
    {
        return $this->addOption('--flush-cache');
    }

    public function forceHandlers(): self
    {
        return $this->addOption('--force-handlers');
    }

    public function listHosts(): self
    {
        return $this->addOption('--list-hosts');
    }

    public function listTags(): self
    {
        return $this->addOption('--list-tags');
    }

    public function startAtTask(string $startAtTask): self
    {
        return $this->addArgument('--start-at-task', $startAtTask);
    }

    public function step(): self
    {
        return $this->addOption('--step');
    }

    public function syntaxCheck(): self
    {
        return $this->addOption('--syntax-check');
    }

    public function vaultId(string $vaultId): self
    {
        return $this->addArgument('--vault-id', $vaultId);
    }

    public function vaultPasswordFile(string $vaultPasswordFile): self
    {
        return $this->addArgument('--vault-password-file', $vaultPasswordFile);
    }

    public function check(): self
    {
        return $this->addOption('--check');
    }

    public function diff(): self
    {
        return $this->addOption('--diff');
    }

    public function askVaultPassword(): self
    {
        return $this->addOption('--ask-vault-pass');
    }

    public function modulePath(string $modulePath): self
    {
        return $this->addArgument('--module-path', $modulePath);
    }

    public function extraVars(array $extraVars): self
    {
        return $this->addArgument('--extra-vars', json_encode($extraVars));
    }

    public function forks(int $forks): self
    {
        return $this->addArgument('--forks', (string)$forks);
    }

    public function inventory(string $inventory): self
    {
        return $this->addArgument('--inventory', $inventory);
    }

    public function limit(string $limit): self
    {
        return $this->addArgument('--limit', $limit);
    }

    public function tags(string $tags): self
    {
        return $this->addArgument('--tags', $tags);
    }

    public function verbose(int $verbose): self
    {
        // Assuming verbose level is controlled by repeating 'v', e.g., -v, -vv, -vvv
        $verboseOption = '-' . str_repeat('v', $verbose);
        return $this->addOption($verboseOption);
    }

    public function askPass(): self
    {
        return $this->addOption('--ask-pass');
    }


    /**
     * Build the command-line arguments array.
     *
     * @return array The command-line arguments.
     */
    public function arguments(): array
    {
        $arguments = [];

        foreach ($this->options as $option) {
            $arguments[] = $option;
        }

        foreach ($this->arguments as $key => $value) {
            $arguments[] = $key . '=' . $value;
        }

        return $arguments;
    }
}
