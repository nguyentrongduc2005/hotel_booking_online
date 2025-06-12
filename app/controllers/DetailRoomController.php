<?php
namespace app\controllers;

use app\core\Controller;
use app\models\DetailRoomModel;

class DetailRoomController extends Controller
{
    private DetailRoomModel $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new DetailRoomModel();
    }

    public function index()
    {
        $rooms = $this->model->getAllRooms();
        $roomDetail = null; 
        require_once __DIR__ . '/../views/home/index.php';
    }

    public function detail()
    {
        $id = $_GET['id'] ?? null;
        $rooms = $this->model->getAllRooms(); 

        if ($id && is_numeric($id)) {
            $roomDetail = $this->model->getRoomById((int)$id);
        } else {
            $roomDetail = null;
        }

        require_once __DIR__ . '/../views/home/index.php';
    }
}
