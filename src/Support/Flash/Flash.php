<?php

namespace Support\Flash;

use Illuminate\Contracts\Session\Session;

class Flash
{
    public const MESSAGE_KEY = 'flash_message';
    public const MESSAGE_CLASS_KEY = 'flash_class';

    public function __construct(protected Session $session)
    {
    }

    public function get(): ?FlashMessage
    {
        $message = $this->session->get(self::MESSAGE_KEY);

        if (!is_string($message)) {
            return null;
        }

        $class = $this->session->get(self::MESSAGE_CLASS_KEY, '');

        if (!is_string($class)) {
            $class = '';
        }

        return new FlashMessage(
            $message,
            $class
        );
    }

    public function info(string $message): void
    {
        $this->flash($message, 'info');
    }

    public function alert(string $message): void
    {
        $this->flash($message, 'alert');
    }

    private function flash(string $message, string $name): void
    {
        $this->session->flash(self::MESSAGE_KEY, $message);
        $this->session->flash(self::MESSAGE_CLASS_KEY, config("flash.$name", ''));
    }
}
