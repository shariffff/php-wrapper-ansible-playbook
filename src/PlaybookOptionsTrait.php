<?php

declare(strict_types=1);

namespace PHPPlay;

/**
 * @method self listTasks()
 * @method self become()
 * @method self flushCache()
 * @method self forceHandlers()
 * @method self listHosts()
 * @method self askBecomePass()
 * @method self listTags()
 * @method self step()
 * @method self syntaxCheck()
 * @method self check()
 * @method self diff()
 * @method self askVaultPass()
 * @method self askPass()
 * @method self skipTags(string $skipTags)
 * @method self privateKeyFile(string $privateKeyFile)
 * @method self scpExtraArgs(string $scpExtraArgs)
 * @method self sftpExtraArgs(string $sftpExtraArgs)
 * @method self sshCommonArgs(string $sshCommonArgs)
 * @method self sshExtraArgs(string $sshExtraArgs)
 * @method self timeout(int $timeout)
 * @method self connection(string $connection)
 * @method self remoteUser(string $remoteUser)
 * @method self becomeMethod(string $becomeMethod)
 * @method self becomeUser(string $becomeUser)
 * @method self becomePasswordFile(string $becomePasswordFile)
 * @method self connectionPasswordFile(string $connectionPasswordFile)
 * @method self startAtTask(string $startAtTask)
 * @method self vaultId(string $vaultId)
 * @method self vaultPasswordFile(string $vaultPasswordFile)
 * @method self modulePath(string $modulePath)
 * @method self extraVars(array $extraVars)
 * @method self forks(int $forks)
 * @method self inventory(string $inventory)
 * @method self limit(string $limit)
 * @method self tags(string $tags)
 * @method self verbose(int $verbose)
 */

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

    public function __call($method, $args)
    {
        $options = [
            'listTasks' => '--list-tasks',
            'become' => '--become',
            'flushCache' => '--flush-cache',
            'forceHandlers' => '--force-handlers',
            'listHosts' => '--list-hosts',
            'askBecomePass' => '--ask-become-pass',
            'listTags' => '--list-tags',
            'step' => '--step',
            'syntaxCheck' => '--syntax-check',
            'check' => '--check',
            'diff' => '--diff',
            'askVaultPass' => '--ask-vault-pass',
            'askPass' => '--ask-pass',
        ];

        $options_with_args = [
            'skipTags' => '--skip-tags',
            'privateKeyFile' => '--private-key',
            'scpExtraArgs' => '--scp-extra-args',
            'sftpExtraArgs' => '--sftp-extra-args',
            'sshCommonArgs' => '--ssh-common-args',
            'sshExtraArgs' => '--ssh-extra-args',
            'timeout' => '--timeout',
            'connection' => '--connection',
            'remoteUser' => '--user',
            'becomeMethod' => '--become-method',
            'becomeUser' => '--become-user',
            'becomePasswordFile' => '--become-password-file',
            'connectionPasswordFile' => '--connection-password-file',
            'startAtTask' => '--start-at-task',
            'vaultId' => '--vault-id',
            'vaultPasswordFile' => '--vault-password-file',
            'modulePath' => '--module-path',
            'forks' => '--forks',
            'inventory' => '--inventory',
            'limit' => '--limit',
            'tags' => '--tags',
        ];
        if (array_key_exists($method, $options)) {
            return $this->addOption($options[$method]);
        } elseif (array_key_exists($method, $options_with_args)) {
            if (empty($args)) {
                throw new \InvalidArgumentException("Method {$method} requires an argument.");
            }
            return $this->addArgument($options_with_args[$method], $args[0]);
        } else {
            throw new \BadMethodCallException("Method {$method} is not available. Available methods are " .  implode(',', array_keys($options)));
        }
    }


    public function extraVars(array $extraVars): self
    {
        return $this->addArgument('--extra-vars', json_encode($extraVars));
    }

    public function verbose(int $verbose): self
    {
        $verboseOption = '-' . str_repeat('v', $verbose);
        return $this->addOption($verboseOption);
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
