<?php


class User
{
    private $email;
    private $password;
    private $nickname;
    private $id;

    public function __construct(string $email, string $password, string $nickname, int $id = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nickname = $nickname;
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
