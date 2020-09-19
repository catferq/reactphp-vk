<?php

namespace ReactPHPVK\Actions\Sections\Groups;

use React\Promise\Promise;
use ReactPHPVK\Client\Provider;

/**
 * Creates a new community.
 */
class Create
{
    private Provider $_provider;
    
    private string $title = '';
    private string $description = '';
    private string $type = 'group';
    private int $publicCategory = 0;
    private int $subtype = 0;
    
    private array $_custom = [];

    public function __construct(Provider $provider)
    {
        $this->_provider = $provider;
    }

    /**
     * ...
     * @param array $value
     * @return Create
     */
    public function _setCustom(array $value): Create
    {
        $this->_custom = $value;
        return $this;
    }

    /**
     * Community title.
     * 
     * @param string $value
     * @return Create
     */
    public function setTitle(string $value): Create
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Community description (ignored for 'type' = 'public').
     * 
     * @param string $value
     * @return Create
     */
    public function setDescription(string $value): Create
    {
        $this->description = $value;
        return $this;
    }

    /**
     * Community type. Possible values: *'group' – group,, *'event' – event,, *'public' – public page
     * 
     * @param string $value
     * @return Create
     */
    public function setType(string $value): Create
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Category ID (for 'type' = 'public' only).
     * 
     * @param int $value
     * @return Create
     */
    public function setPublicCategory(int $value): Create
    {
        $this->publicCategory = $value;
        return $this;
    }

    /**
     * Public page subtype. Possible values: *'1' – place or small business,, *'2' – company, organization or website,, *'3' – famous person or group of people,, *'4' – product or work of art.
     * 
     * @param int $value
     * @return Create
     */
    public function setSubtype(int $value): Create
    {
        $this->subtype = $value;
        return $this;
    }

    /**
     * @param bool $withClear
     * @return Promise
     */
    public function execute(bool $withClear = true): Promise
    {
        $params = [];

        $params['title'] = $this->title;
        if ($this->description !== '') $params['description'] = $this->description;
        if ($this->type !== 'group') $params['type'] = $this->type;
        if ($this->publicCategory !== 0) $params['public_category'] = $this->publicCategory;
        if ($this->subtype !== 0) $params['subtype'] = $this->subtype;
        if ($this->_custom !== []) $params = array_merge($params, $this->_custom);

        if ($withClear) {
            $this->title = '';
            $this->description = '';
            $this->type = 'group';
            $this->publicCategory = 0;
            $this->subtype = 0;
            $this->_custom = [];
        }

        return $this->_provider->request('groups.create', $params);
    }
}