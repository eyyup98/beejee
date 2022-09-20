<?php


class AdminTasks extends Tasks
{
    /**
     * Метод выводит задачу админу для редактирования
     *
     * @param int $id
     * @return array
     */
    public function findTask(int $id): array
    {
        $rows = $this->pdo->getPdo()->query("SELECT * FROM tasks WHERE id = $id; ");
        while ($row[] = $rows->fetch()) { }
        if (!empty($row[0])) {
            return $row[0];
        } else {
            die('Ошибка! Задача не найдена!');
        }
    }

    /**
     * Метод для изменения текста задачи
     *
     * @param int $id
     * @param string $text
     */
    public function updateText(int $id, string $text): void
    {
        try {
            !$this->pdo->getPdo()->exec(
                "UPDATE tasks SET text = '$text' WHERE id = $id; "
            );
        } catch (Exception $e) {
            die('Ошибка при изменении текста задачи!. ' . $e->getMessage());
        }
    }

    /**
     * Метод для изменения стстуса
     *
     * @param int $id
     * @param int $status
     */
    public function updateStatus(int $id, int $status): void
    {
        try {
            !$this->pdo->getPdo()->exec(
                "UPDATE tasks SET status = $status WHERE id = $id; "
            );
        } catch (Exception $e) {
            die('Ошибка при изменении статуса задачи!. ' . $e->getMessage());
        }
    }
}