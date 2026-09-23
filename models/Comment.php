<?php

class Comment extends Model
{
    public function create($photoId, $userId, $comment)
    {
        $sql = "INSERT INTO comments
                (photo_id, user_id, comment, date_time)
                VALUES
                (:photo_id, :user_id, :comment, NOW())";

        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ":photo_id" => $photoId,
            ":user_id" => $userId,
            ":comment" => $comment
        ]);
    }

    public function getByPhotoId($photoId)
    {
        $sql = "SELECT
                    comments.id,
                    comments.photo_id,
                    comments.user_id,
                    comments.comment,
                    comments.date_time,
                    users.first_name,
                    users.last_name
                FROM comments
                INNER JOIN users
                    ON comments.user_id = users.id
                WHERE comments.photo_id = :photo_id
                ORDER BY comments.date_time ASC";

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            ":photo_id" => $photoId
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}