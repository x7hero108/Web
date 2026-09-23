<?php

class Photo extends Model
{
    public function create(
        $userId,
        $fileName,
        $title,
        $description
    ) {
        $sql = "INSERT INTO photos
                (user_id, file_name, title, description, date_time)
                VALUES
                (:user_id, :file_name, :title, :description, NOW())";

        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ":user_id" => $userId,
            ":file_name" => $fileName,
            ":title" => $title,
            ":description" => $description
        ]);
    }

    public function getAll()
    {
        $sql = "SELECT
                    photos.id,
                    photos.user_id,
                    photos.file_name,
                    photos.title,
                    photos.description,
                    photos.date_time,
                    users.first_name,
                    users.last_name
                FROM photos
                INNER JOIN users
                    ON photos.user_id = users.id
                ORDER BY photos.date_time DESC";

        $statement = $this->connection->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT
                    photos.id,
                    photos.user_id,
                    photos.file_name,
                    photos.title,
                    photos.description,
                    photos.date_time,
                    users.first_name,
                    users.last_name
                FROM photos
                INNER JOIN users
                    ON photos.user_id = users.id
                WHERE photos.id = :id";

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            ":id" => $id
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM photos
                WHERE id = :id";

        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ":id" => $id
        ]);
    }
}