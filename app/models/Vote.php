<?php

class Vote extends Model
{
    function __construct($pdo)
    {
        parent::__construct($pdo);
    }

    private function validateVoteType($vote_type): bool
    {
        if ($vote_type !== 'up' && $vote_type !== 'down') {
            $this->error_message = 'Invalid vote type';
            return false;
        }
        return true;
    }

    /**
     * Vote on a specific topic
     */
    public function vote($user_id, $topic_id, $vote_type): bool
    {
        if (!$this->validateVoteType($vote_type)) return false;
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Votes (user_id, topic_id, vote_type) VALUES (:user_id, :topic_id, :vote_type)");
            $exec = $stmt->execute([
                ':user_id' => $user_id,
                ':topic_id' => $topic_id,
                ':vote_type' => $vote_type
            ]);
            return true;
        } catch (Exception $e) {
            $this->error_message = 'Failed to vote: (' . $e->getMessage() . ')';
            return false;
        }
    }

    /**
     * Check if a user has voted on a specific topic
     */
    public function hasVoted($user_id, $topic_id): bool
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Votes WHERE topic_id = :topic_id AND user_id = :user_id");
            $stmt->execute([':topic_id' => $topic_id, ':user_id' => $user_id]);
            $vote = $stmt->fetch();
            return (bool)$vote;
        } catch (Exception $e) {
            $this->error_message = 'Failed to check if user has voted: (' . $e->getMessage() . ')';
            return false;
        }
    }

    /**
     * Get all votes made by a specific user
     */
    public function getUserVoteHistory($user_id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Votes WHERE user_id = :user_id");
            $stmt->execute([':user_id' => $user_id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->error_message = 'Failed to get user vote history: (' . $e->getMessage() . ')';
            return false;
        }
    }

    /**
     * Get vote count for a specific topic
     */
    public function getTopicVotes($topic_id)
    {
        $up = 0;
        $down = 0;
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Votes WHERE topic_id = :topic_id");
            $stmt->execute([':topic_id' => $topic_id]);
            $votes = $stmt->fetchAll();
            foreach ($votes as $vote) {
                if ($vote['vote_type'] === 'up') $up++;
                if ($vote['vote_type'] === 'down') $down++;
            }
        } catch (PDOException $e) {
            $this->error_message = 'Failed to get topic votes: (' . $e->getMessage() . ')';
        }
        return [
            'up' => $up,
            'down' => $down
        ];
    }

    /**
     * Get vote option for a specific user on a specific topic
     */
    public function getUserVoteOption($user_id, $topic_id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Votes WHERE user_id = :user_id AND topic_id = :topic_id");
            $stmt->execute([':user_id' => $user_id, ':topic_id' => $topic_id]);
            $vote = $stmt->fetchAll()[0];
            return $vote ? $vote['vote_type'] : null;
        } catch (PDOException $e) {
            $this->error_message = 'Failed to get user vote option: (' . $e->getMessage() . ')';
            return null;
        }
    }
}