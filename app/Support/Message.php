<?php


namespace LaraDev\Support;


class Message
{
    private $text;
    private $type;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }


    public function info(string $message): Message
    {
        $this->text = $message;
        $this->type = 'info';

        return $this;
    }
    public function warning(string $message): Message
    {
        $this->text = $message;
        $this->type = 'warning';

        return $this;
    }

    public function success(string $message): Message
    {
        $this->text = $message;
        $this->type = 'sucsses';

        return $this;
    }

    public function error(string $message): Message
    {
        $this->text = $message;
        $this->type = 'error';

        return $this;
    }

    public function render()
    {
        return "<div class='message {$this->getType()}'>{$this->getText()}</div>";
    }

}
