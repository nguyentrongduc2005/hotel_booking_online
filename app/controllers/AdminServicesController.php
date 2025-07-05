<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\AdminServicesModel;

class AdminServicesController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AdminServicesModel();
    }

    // Hiển thị danh sách service + tìm kiếm theo tên
    public function index(Request $req, $res)
    {
        $search = $req->query('search');
        $services = $this->model->getAllServices($search);

        return $this->render('index', [
            'services' => $services,
            'search' => $search
        ]);
    }

    // Thêm
    public function create(Request $req, $res)
    {
        $data = [
            'name' => $req->post('name'),
            'description' => $req->post('description')
        ];

        $success = $this->model->addService($data);

        if ($success) {
            return $res->redirect('services');
        }

        return $res->json(['error' => 'Thêm dịch vụ thất bại'], 400);
    }

    // Cập nhật
    public function update(Request $req, $res)
    {
        $data = [
            'id_service' => $req->post('id_service'),
            'name' => $req->post('name'),
            'description' => $req->post('description')
        ];

        $success = $this->model->editService($data);

        if ($success) {
            return $res->redirect('services');
        }

        return $res->json(['error' => 'Cập nhật thất bại'], 400);
    }

    // Xoá
    public function delete(Request $req, $res)
    {
        $id = $req->query('id_service');
        $success = $this->model->deleteService($id);

        if ($success) {
            return $res->redirect('services');
        }

        return $res->json(['error' => 'Xoá thất bại'], 400);
    }
}
