<?php

namespace ReactPHPVK\Actions\Sections\Docs;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Returns the server address for document upload.
 */
class GetMessagesUploadServer
{
    private Provider $_provider;
    
    private string $type = 'doc';
    private int $peerId = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return GetMessagesUploadServer
     */
    public function _setCustom(array $value): GetMessagesUploadServer
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Document type.
     * 
     * @param string $value
     * @return GetMessagesUploadServer
     */
    public function setType(string $value): GetMessagesUploadServer
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'Chat ID', e.g. '2000000001'. For community: '- Community ID', e.g. '-12345'. "
     * 
     * @param int $value
     * @return GetMessagesUploadServer
     */
    public function setPeerId(int $value): GetMessagesUploadServer
    {
        $this->peerId = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = false): Promise
    {
        $params = [];

        if ($this->type !== 'doc') $params['type'] = $this->type;
        if ($this->peerId !== 0) $params['peer_id'] = $this->peerId;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->type = 'doc';
            $this->peerId = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('docs.getMessagesUploadServer', $params);
    }
}