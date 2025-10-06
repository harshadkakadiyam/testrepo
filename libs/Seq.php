<?php
class Seq
{
    public static function next(string $name): int
    {
        $pdo = Database::getConnection();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('SELECT current_value FROM sequences WHERE seq_name = ? FOR UPDATE');
            $stmt->execute([$name]);
            $row = $stmt->fetch();
            if (!$row) {
                $pdo->prepare('INSERT INTO sequences (seq_name, current_value) VALUES (?, 0)')->execute([$name]);
                $current = 0;
            } else {
                $current = (int)$row['current_value'];
            }
            $next = $current + 1;
            $pdo->prepare('UPDATE sequences SET current_value = ? WHERE seq_name = ?')->execute([$next, $name]);
            $pdo->commit();
            return $next;
        } catch (Throwable $e) {
            $pdo->rollBack();
            throw $e;
        }
    }
}
