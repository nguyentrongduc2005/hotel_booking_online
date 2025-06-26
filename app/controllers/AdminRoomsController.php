<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Registry;
use app\models\AdminRoomsModel;


class AdminRoomsController extends Controller
{
    private $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new AdminRoomsModel();
    }


    function roomsShow($req, $res)
    {

        $data = $this->model->getAllRooms();
        $nameRoomTypes = $this->model->getNameRoomTypes();
        $data['nameRoomTypes'] = $nameRoomTypes;
        $amenities = $this->model->getAllAmenities();
        $data['amenities'] = $amenities;
        foreach ($data as $key => $value) {
            if (isset($value['images'])) {
                $data[$key]['images'] = $this->model->getImagesByRoomId($value['id_room']);
            }
        }
        $this->render('rooms', $data);
    }

    function roomFilter($req, $res)
    {
        $requestData = $req->post();
        $data = $this->model->getDataByFilter($requestData);
        $nameRoomTypes = $this->model->getNameRoomTypes();
        $data['nameRoomTypes'] = $nameRoomTypes;
        $amenities = $this->model->getAllAmenities();
        $data['amenities'] = $amenities;
        foreach ($data as $key => $value) {
            if (isset($value['images'])) {
                $data[$key]['images'] = $this->model->getImagesByRoomId($value['id_room']);
            }
        }
        $this->render('rooms', $data);
    }

    function roomAdd($req, $res)
    {
        $requestData = $req->post();
        if (!empty($req->file('images'))) {
            $requestData['images'] = $req->file('images');
        }
        $check =  $this->model->addRoom($requestData);
        if ($check) {
            $this->redirect(Registry::getInstance()->config['basePath'] . '/admin/rooms');
        } else {
            $this->renderPartial("error/index", ["message" => "Failed to insert data. The record may already exist.", "next" => $this->getConfig("basePath") . "/admin/rooms", "timeout" => 5]);
        }
    }


    function roomEdit($req, $res)
    {
        $requestData = $req->post();

        if (!empty($req->file('new_images'))) {
            $requestData['new_images'] = $req->file('new_images');
        }

        $check =  $this->model->editRoom($requestData);
        if ($check) {
            $this->redirect(Registry::getInstance()->config['basePath'] . '/admin/rooms');
        } else {
            $this->renderPartial("error/index", ["message" => "Failed to insert data. The record may already exist.", "next" => $this->getConfig("basePath") . "/admin/rooms", "timeout" => 5]);
        }
    }
    function roomDelete($req, $res)
    {
        $requestData = $req->post();
        $check =  $this->model->deleteRoom($requestData['id_room']);
        if ($check) {
            $this->redirect(Registry::getInstance()->config['basePath'] . '/admin/rooms');
        } else {
            $this->renderPartial("error/index", ["message" => "Failed to delete data. The record may already exist.", "next" => $this->getConfig("basePath") . "/admin/rooms", "timeout" => 5]);
        }
    }
    ///////////////////////////////////////////////////////////////////////////////Type Rooms////////////////////////////////////////////////////
    function typeRoomsShow($req, $res)
    {
        $data = $this->model->getNameRoomTypes();
        $this->render('typeroom', $data);
    }
    function typeRoomsAdd($req, $res)
    {
        $requestData = $req->post();
        $check =  $this->model->addTypeRoom($requestData);
        if ($check) {
            $this->redirect(Registry::getInstance()->config['basePath'] . '/admin/roomtypes');
        } else {
            $this->renderPartial("error/index", ["message" => "Failed to insert data. The record may already exist.", "next" => $this->getConfig("basePath") . "/admin/roomtypes", "timeout" => 5]);
        }
    }
    function typeRoomsEdit($req, $res)
    {
        $requestData = $req->post();
        $check =  $this->model->editTypeRoom($requestData);
        if ($check) {
            $this->redirect(Registry::getInstance()->config['basePath'] . '/admin/roomtypes');
        } else {
            $this->renderPartial("error/index", ["message" => "Failed to update data. The record may already exist.", "next" => $this->getConfig("basePath") . "/admin/roomtypes", "timeout" => 5]);
        }
    }
    function typeRoomsDelete($req, $res)
    {
        $requestData = $req->post();
        $check =  $this->model->deleteTypeRoom($requestData['id_type_room']);
        if ($check) {
            $this->redirect(Registry::getInstance()->config['basePath'] . '/admin/roomtypes');
        } else {
            $this->renderPartial("error/index", ["message" => "Failed to delete data. The record may already exist.", "next" => $this->getConfig("basePath") . "/admin/roomtypes", "timeout" => 5]);
        }
    }



    ///////////////////////////////////////////////////////////////////////////////End Type Rooms////////////////////////////////////////////////////
    function amenitiesShow($req, $res)
    {
        $data = $this->model->getAllAmenities();
        $this->render('amenities', $data);
    }
    function amenitiesAdd($req, $res)
    {
        $requestData = $req->post();
        $check =  $this->model->addAmenities($requestData);
        if ($check) {
            $this->redirect(Registry::getInstance()->config['basePath'] . '/admin/amenities');
        } else {
            $this->renderPartial("error/index", ["message" => "Failed to insert data. The record may already exist.", "next" => $this->getConfig("basePath") . "/admin/amenities", "timeout" => 5]);
        }
    }
    function amenitiesEdit($req, $res)
    {
        $requestData = $req->post();
        $check =  $this->model->editAmenities($requestData);
        if ($check) {
            $this->redirect(Registry::getInstance()->config['basePath'] . '/admin/amenities');
        } else {
            $this->renderPartial("error/index", ["message" => "Failed to update data. The record may already exist.", "next" => $this->getConfig("basePath") . "/admin/amenities", "timeout" => 5]);
        }
    }
    function amenitiesDelete($req, $res)
    {
        $requestData = $req->post();
        $check =  $this->model->deleteAmenities($requestData['id_amenity']);
        if ($check) {
            $this->redirect(Registry::getInstance()->config['basePath'] . '/admin/amenities');
        } else {
            $this->renderPartial("error/index", ["message" => "Failed to delete data. The record may already exist.", "next" => $this->getConfig("basePath") . "/admin/amenities", "timeout" => 5]);
        }
    }

    ///////////////////////////////////////////////////////////////////////////////End Amenities////////////////////////////////////////////////////
    function __destruct()
    {
        // Cleanup if necessary
        // For example, close database connections or release resources
        unset($this->model);
    }
}
