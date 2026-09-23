<?php

class User extends Model
{
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            ":email" => $email
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create(
        $firstName,
        $lastName,
        $email,
        $password,
        $location,
        $description,
        $occupation
    ) {
        $sql = "INSERT INTO users
                (first_name, last_name, email, password, location, description, occupation)
                VALUES
                (:first_name, :last_name, :email, :password, :location, :description, :occupation)";

        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ":first_name" => $firstName,
            ":last_name" => $lastName,
            ":email" => $email,
            ":password" => $password,
            ":location" => $location,
            ":description" => $description,
            ":occupation" => $occupation
        ]);
    }
}