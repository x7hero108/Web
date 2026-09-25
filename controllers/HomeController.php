<?php

class HomeController extends Controller
{
    public function index()
    {
        $this->requireLogin();

        // Create Photo Model
        $photoModel = new Photo();

        // Get all photos
        $photos = $photoModel->getAll();

        // Send photos to the view
        $this->view("home", [
            "photos" => $photos
        ]);
    }
}