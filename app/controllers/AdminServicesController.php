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
    // Dữ liệu text từ form
    $data = [
        'name' => $req->post('name'),
        'description' => $req->post('description'),
    ];

    // Xử lý file ảnh
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/services/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('service_') . '.' . $ext;
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $data['Path_img'] = $targetPath;
        }
    }

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
        'id_service' => $req->param('id'),
        'name' => $req->post('name'),
        'description' => $req->post('description'),
    ];

    // Xử lý ảnh nếu có upload mới
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/services/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('service_') . '.' . $ext;
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $data['Path_img'] = $targetPath;
        }
    }

    $success = $this->model->editService($data);

    if ($success) {
        return $res->redirect('services');
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
