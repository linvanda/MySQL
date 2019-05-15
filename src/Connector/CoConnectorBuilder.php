<?php

namespace Linvanda\Fundation\MySQL\Connector;

class CoConnectorBuilder implements IConnectorBuilder
{
    protected $writeConfig;
    protected $readConfigs;

    /**
     * CoConnectorBuilder constructor.
     * @param DBConfig $writeConfig
     * @param array $readConfigs
     * @throws \Exception
     */
    public function __construct(DBConfig $writeConfig, array $readConfigs)
    {
        foreach ($readConfigs as $config) {
            if (!($config instanceof DBConfig)) {
                throw new \Exception("error DBConfig object");
            }
        }

        $this->writeConfig = $writeConfig;
        $this->readConfigs = $readConfigs;
    }

    /**
     * 创建并返回 IConnector 对象
     * @param string $connType read/write
     * @return IConnector
     */
    public function build(string $connType = 'write'): IConnector
    {
        /** @var DBConfig */
        $config = $connType == 'read' ? $this->getReadConfig() : $this->writeConfig;

        return new CoConnector($config->host, $config->user, $config->password, $config->database, $config->port, $config->timeout, $config->charset, $config->autoConnect);
    }

    private function getReadConfig()
    {
        return $this->readConfigs[mt_rand(0, count($this->readConfigs) - 1)];
    }
}