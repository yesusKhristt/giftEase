<?php

class UserModel {
    private $users;

    public function __construct($filePath) {
        $this->users = json_decode(file_get_contents($filePath), true);
    }

    public function authenticate($email, $password) {
        foreach ($this->users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                return $user;
            }
        }
        return null;
    }
}
