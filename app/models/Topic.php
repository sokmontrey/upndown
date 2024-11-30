<?php

class Topic extends Model
{
    private function validateTitle($title): bool {
        if (!empty($title)) return true;
        $this->error_message = 'Title cannot be empty';
        return false;
    }

    private function validateDescription($description): bool {
        if (!empty($description)) return true;
        $this->error_message = 'Description cannot be empty';
        return false;
    }

    public function createTopic($user_id, $title, $description): bool
    {
        if (!$this->validateTitle($title)) return false;
        if (!$this->validateDescription($description)) return false;
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Topics (user_id, title, description) VALUES (:user_id, :title, :description)");
            $stmt->execute([
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
            $topics = $stmt->fetchAll();
            foreach ($topics as $key => $topic) {
                $topics[$key] = new Topic($this->pdo);
                $topics[$key]->id = $topic['id'];
                $topics[$key]->user_id = $topic['user_id'];
                $topics[$key]->title = $topic['title'];
                $topics[$key]->description = $topic['description'];
                $topics[$key]->created_at = $topic['created_at'];
            }
            return $topics;
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