<?php

class Topic extends Model
{
    public function createTopic($user_id, $title, $description): bool
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Topics (user_id, title, description) VALUES (:user_id, :title, :description)");
            $exec = $stmt->execute([
                ':user_id' => $user_id,
                ':title' => $title,
                ':description' => $description
            ]);
            return true;
        } catch (PDOException $e) {
            $this->error_message = 'Failed to create topic: (' . $e->getMessage() . ')';
            return false;
        }
    }

    /**
     * Get all topics
     */
    public function getTopics()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Topics");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->error_message = 'Failed to get topics: (' . $e->getMessage() . ')';
            return false;
        }
    }

    /**
     * Get a specific topic by id
     */
    public function getTopic($topic_id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Topics WHERE id = :topic_id");
            $stmt->execute([':topic_id' => $topic_id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            $this->error_message = 'Failed to get topic: (' . $e->getMessage() . ')';
            return false;
        }
    }

    /**
     * Get topics created by a specific user
     **/
    public function getCreatedTopics($user_id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Topics WHERE user_id = :user_id");
            $stmt->execute([':user_id' => $user_id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->error_message = 'Failed to get topics: (' . $e->getMessage() . ')';
            return false;
        }
    }
}