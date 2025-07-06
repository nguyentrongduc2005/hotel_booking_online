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

        // Set component view to admin for this controller
        self::setcomponent('/admin');
        // Set admin layout
        self::setLayout('AdminLayouts/main');

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
            return $res->json(['success' => true, 'message' => 'Thêm dịch vụ thành công']);
        }

        return $res->json(['error' => 'Thêm dịch vụ thất bại'], 400);
    }

    // Cập nhật
    public function update(Request $req, $res)
    {
        $data = [
            'id_service' => $req->param('id'),
            'name' => $req->post('name'),
            'description' => $req->post('description')
        ];

        $success = $this->model->editService($data);

        if ($success) {
            return $res->json(['success' => true, 'message' => 'Cập nhật dịch vụ thành công']);
        }

        return $res->json(['error' => 'Cập nhật thất bại'], 400)->send();
    }

    // Xoá
    public function delete(Request $req, $res)
    {
        $id = $req->param('id');
        $success = $this->model->deleteService($id);

        if ($success) {
            return $res->json(['success' => true, 'message' => 'Xóa dịch vụ thành công']);
        }

        return $res->json(['error' => 'Xoá thất bại'], 400)->send();
    }
}
