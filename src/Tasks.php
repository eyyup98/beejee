<?php


class Tasks
{
    /**
     * @var Database
     */
    protected Database $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }

    /**
     * Метод для создания задачи
     *
     * @param string $user
     * @param string $email
     * @param string $text
     */
    public function createTask(string $user, string $email, string $text): void
    {
        try {
            !$this->pdo->getPdo()->exec(
            "INSERT INTO tasks (`user`, `email`, `text`)
                        VALUES ('$user', '$email', '$text'); "
            );
        } catch (Exception $e) {
            die('Ошибка при добавлении задачи!. ' . $e->getMessage());
        }
    }

    /**
     * Метод для вывода задач
     *
     * @param int $page
     * @param int $to
     * @param string $sort
     * @return array
     */
    public function getList(int $page, int $to, string $sort = 'user'): array
    {
        $from = $page * $to - $to;
        $sort == 'status' ? $sort .= ' DESC' : $sort;
        $rows = $this->pdo->getPdo()->query("SELECT * FROM tasks ORDER BY $sort LIMIT $from, $to; ");
        while ($row[] = $rows->fetch()) {}
        return $row ?? [];
    }

    /**
     * Метод для получения количества всех задач
     *
     * @return int
     */
    public function getNumberList(): int
    {
        $rows = $this->pdo->getPdo()->query("SELECT COUNT(*)  FROM tasks; ");
        return $rows->fetch()[0];
    }

    /**
     * Метод для вывода списка сортировки
     *
     * @return string[]
     */
    public function getSortList(): array
    {
        return ['user' => 'Имя пользователя', 'email' => 'Почта', 'status' => 'Стстус'];
    }

}