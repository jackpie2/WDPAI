<?php


class User
{
    private $email;
    private $password;
    private $nickname;
    private $id;

    private $role;

    public function __construct(string $email, string $password, string $nickname, int $id = null, int $role = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nickname = $nickname;
        $this->id = $id;
        $this->role = $role;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): void
    {
        $this->role = $role;
    }
}
