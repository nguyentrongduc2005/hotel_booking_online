<?php

namespace app\controllers;


use app\core\Controller;
use app\models\DetailRoomModel;

class DetailRoomController extends Controller
{
    private  $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new DetailRoomModel();
    }


    // public function index($req, $res)
    // {
    //     $slug = $req->params()['slug'];
    //     $images = $this->model->getImages($slug);
    //     $amenities = $this->model->getAmenities($slug);
    //     $data = $this->model->getRoomBySlug($slug);
    //     $data['images'] = $images;
    //     $data['amenities'] = $amenities;
    //     $this->render('index', $data);
    // }

    public function index($req, $res)
    {
        $slug = $req->params()['slug'];

        $images = $this->model->getImages($slug);
        $amenities = $this->model->getAmenities($slug);
        $data = $this->model->getRoomBySlug($slug);

        // if (!$data) {
        //     $res->setStatusCode(404);
        //     echo "Không tìm thấy phòng";
        //     return;
        // }

        $data['images'] = $images;
        $data['amenities'] = $amenities;
        // echo "<pre>";
        // print_r($data);

        // echo "</pre>";

        $this->render('index', $data);
    }
}
