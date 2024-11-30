<?php

class Comment extends Model
{
    private function validateComment($comment): bool {
        if (!empty($comment)) return true;
        $this->error_message = 'Comment cannot be empty';
        return false;
    }

    public function addComment($user_id, $topic_id, $comment): bool
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Comments (user_id, topic_id, comment) VALUES (:user_id, :topic_id, :comment)");
            $stmt->execute([
                ':user_id' => $user_id,
                ':topic_id' => $topic_id,
                ':comment' => $comment
            ]);
            return true;
        } catch (Exception $e) {
            $this->error_message = 'Failed to add comment: (' . $e->getMessage() . ')';
            return false;
        }
    }

    public function getComments($topic_id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Comments WHERE topic_id = :topic_id");
            $stmt->execute([':topic_id' => $topic_id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->error_message = 'Failed to get comments: (' . $e->getMessage() . ')';
            return false;
        }
    }
}