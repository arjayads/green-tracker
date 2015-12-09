<?php

namespace app;

class ResponseEntity
{

    protected $success = false;
    protected $isAuthorized;
    protected $messages;
    protected $data;
    protected $message;

    function __construct($success = false, $isAuthorized = null, array $messages = [], array $data = [], $message = null)
    {
        $this->success = $success;
        $this->isAuthorized = $isAuthorized;
        $this->messages = $messages;
        $this->data = $data;
        $this->message = $message;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }


    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function isSuccess()
    {
        return $this->success;
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