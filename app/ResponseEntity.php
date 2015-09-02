<?php

namespace app;

class ResponseEntity
{

    protected $success = false;
    protected $isAuthorized;
    protected $messages;
    protected $data;

    function __construct($success = false, $isAuthorized = null, array $messages = [], array $data = [])
    {
        $this->success = $success;
        $this->isAuthorized = $isAuthorized;
        $this->messages = $messages;
        $this->data = $data;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @param boolean $isAuthorized
     */
    public function setIsAuthorized($isAuthorized)
    {
        $this->isAuthorized = $isAuthorized;
    }

    /**
     * @param array $messages
     */
    public function setMessages(array $messages)
    {
        $this->messages = $messages;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }


}