<?php

class Session {
    private $id, $data, $is_started;

    public function __construct() {
        $this->id = null;
        $this->data = [];
        $this->is_started = false;

        if (session_status() == PHP_SESSION_ACTIVE) {
            $this->is_started = true;
            $this->id = session_id();
            $this->data = $_SESSION;
        } else if (isset($_COOKIE[session_name()])) {
            session_start();
            $this->is_started = true;
            $this->id = session_id();
            $this->data = $_SESSION;
        }
    }

    public function start() {
        if (session_status() == PHP_SESSION_NONE) {
            $this->id = bin2hex(random_bytes(16));
            session_id($this->id);
            session_start();
            $this->is_started = true;
        } else if(!$this->is_started) {
            $this->id = session_id();
            $this->is_started = true;
        }
    }

    public function set(string $key, $val) {
        $_SESSION[$key] = $val;
        $this->data[$key] = $val;
    }
    public function has(string $key) {
        if (isset($_SESSION[$key])) {
            if (!isset($this->data[$key])) {
                $this->data[$key] = $_SESSION[$key];
            }
            return true;
        }
        return false;
    }

    public function get(string $key) {
        if (!$this->has($key)) {
            throw new Exception("Session data does not contain key `{$key}`.");
        }

        if (!isset($this->data[$key])) {
            $this->data[$key] = $_SESSION[$key];
        }
        return $this->data[$key];
    }
    public function remove(string $key) {
        if (!$this->has($key)) {
            throw new Exception("Session data does not contain key `{$key}`.");
        }
        unset($_SESSION[$key]);
        unset($this->data[$key]);
    }

    public function regenerate() {
        if ($this->is_started) {
            session_regenerate_id(true);
            $this->id = session_id();
        } else {
            $this->start();
        }
    }

    public function destroy() {
        if ($this->is_started) {
            session_unset();
            session_destroy();

            $this->id = null;
            $this->data = [];
            $this->is_started = false;
        }
    }

    public function getId() : int {
        return $this->id;
    }
    public function isStarted() : bool {
        if (session_status() == PHP_SESSION_ACTIVE) {
            if (!$this->is_started) {
                $this->id = id;
                $this->data = $_SESSION;
                $this->is_started = true;
            }
            return true;
        }
        return false;
    }
}