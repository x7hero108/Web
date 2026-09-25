<?php

class PhotoController extends Controller
{
    public function upload()
    {
        $this->requireLogin();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $this->view("upload", [
                "csrf_token" => $this->csrfToken()
            ]);

            return;
        }

        $this->verifyCsrf();

        $title = trim($_POST["title"] ?? "");
        $description = trim($_POST["description"] ?? "");

        $errors = [];

        if ($title === "") {
            $errors[] = "Photo title is required.";
        }

        if (!isset($_FILES["photo"])) {
            $errors[] = "Please select a photo.";
        }

        if (!empty($errors)) {

            $this->view("upload", [
                "errors" => $errors,
                "csrf_token" => $this->csrfToken()
            ]);

            return;
        }

        $photo = $_FILES["photo"];

        if ($photo["error"] !== UPLOAD_ERR_OK) {

            $this->view("upload", [
                "errors" => [
                    "There was a problem uploading the photo."
                ],
                "csrf_token" => $this->csrfToken()
            ]);

            return;
        }

        $maxSize = 5 * 1024 * 1024;

        if ($photo["size"] > $maxSize) {

            $this->view("upload", [
                "errors" => [
                    "Maximum image size is 5 MB."
                ],
                "csrf_token" => $this->csrfToken()
            ]);

            return;
        }

        $allowedMimeTypes = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/gif" => "gif",
            "image/webp" => "webp"
        ];

        $imageInfo = getimagesize($photo["tmp_name"]);

        if ($imageInfo === false) {

            $this->view("upload", [
                "errors" => [
                    "The uploaded file is not a valid image."
                ],
                "csrf_token" => $this->csrfToken()
            ]);

            return;
        }

        $mimeType = $imageInfo["mime"];

        if (!isset($allowedMimeTypes[$mimeType])) {

            $this->view("upload", [
                "errors" => [
                    "Only JPG, PNG, GIF and WEBP images are allowed."
                ],
                "csrf_token" => $this->csrfToken()
            ]);

            return;
        }

        $extension = $allowedMimeTypes[$mimeType];

        $fileName = bin2hex(random_bytes(16)) . "." . $extension;

        $uploadDirectory = __DIR__ . "/../uploads/";

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $filePath = $uploadDirectory . $fileName;

        if (!move_uploaded_file(
            $photo["tmp_name"],
            $filePath
        )) {

            $this->view("upload", [
                "errors" => [
                    "Failed to save the photo."
                ],
                "csrf_token" => $this->csrfToken()
            ]);

            return;
        }

        $photoModel = new Photo();

        $created = $photoModel->create(
            $_SESSION["user_id"],
            $fileName,
            $title,
            $description
        );

        if (!$created) {

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $this->view("upload", [
                "errors" => [
                    "Photo could not be saved in the database."
                ],
                "csrf_token" => $this->csrfToken()
            ]);

            return;
        }

        header("Location: /alzikrayat/");
        exit;
    }


    public function details($id)
    {
        $this->requireLogin();

        $photoModel = new Photo();

        $photo = $photoModel->getById($id);

        if (!$photo) {
            http_response_code(404);
            echo "Photo not found.";
            return;
        }

        $commentModel = new Comment();

        $comments = $commentModel->getByPhotoId($id);

        $this->view("photo-details", [
            "photo" => $photo,
            "comments" => $comments,
            "csrf_token" => $this->csrfToken()
        ]);
    }


    public function comment($photoId)
    {
        $this->requireLogin();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /alzikrayat/photo/" . $photoId);
            exit;
        }

        $this->verifyCsrf();

        $comment = trim($_POST["comment"] ?? "");

        if ($comment === "") {
            header("Location: /alzikrayat/photo/" . $photoId);
            exit;
        }

        $photoModel = new Photo();

        $photo = $photoModel->getById($photoId);

        if (!$photo) {
            http_response_code(404);
            echo "Photo not found.";
            return;
        }

        $commentModel = new Comment();

        $commentModel->create(
            $photoId,
            $_SESSION["user_id"],
            $comment
        );

        header("Location: /alzikrayat/photo/" . $photoId);
        exit;
    }


    public function delete($id)
    {
        $this->requireLogin();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /alzikrayat/");
            exit;
        }

        $this->verifyCsrf();

        $photoModel = new Photo();

        $photo = $photoModel->getById($id);

        if (!$photo) {
            http_response_code(404);
            echo "Photo not found.";
            return;
        }

        if (
            (int)$photo["user_id"] !==
            (int)$_SESSION["user_id"]
        ) {
            http_response_code(403);
            echo "You are not allowed to delete this photo.";
            return;
        }

        $filePath =
            __DIR__ . "/../uploads/" . $photo["file_name"];

        $deleted = $photoModel->delete($id);

        if ($deleted && file_exists($filePath)) {
            unlink($filePath);
        }

        header("Location: /alzikrayat/");
        exit;
    }
}