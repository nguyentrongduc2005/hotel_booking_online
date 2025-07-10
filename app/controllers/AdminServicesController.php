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
            'description' => $req->post('description'),
        ];

        // Xử lý file ảnh
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'public/assets/img/service/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid('service_') . '.' . $ext;
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                // Lưu path public để show lên web
                $data['Path_img'] = '/public/public/assets/img/service' . $fileName;
            }
        }

        $success = $this->model->addService($data);

        if ($success) {
            // Trả về JSON thay vì redirect
            return $res->json(['success' => true])->send();
        }

        return $res->json(['error' => 'Thêm dịch vụ thất bại'], 400);
    }


    // Cập nhật
    public function update(Request $req, $res)
    {
        try {
            $data = [
                'id_service' => $req->param('id'),
                'name' => $req->post('name'),
                'description' => $req->post('description'),
            ];

            // Lấy service hiện tại để biết ảnh cũ
            $service = $this->model->getServiceById($data['id_service']);
            $oldImg = $service['Path_img'] ?? null;

            // Nếu tick xóa ảnh
            if ($req->post('delete_image')) {
                if ($oldImg && file_exists('public/assets' . $oldImg)) {
                    @unlink('public/assets' . $oldImg);
                }
                $data['Path_img'] = null;
            }

            // Nếu upload ảnh mới thì thay thế ảnh cũ
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'public/assets/img/service/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid('service_') . '.' . $ext;
                $targetPath = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    // Xóa file cũ nếu có
                    if ($oldImg && file_exists('public/assets' . $oldImg)) {
                        @unlink('public/assets' . $oldImg);
                    }
                    $data['Path_img'] = '/img/service/' . $fileName;
                }
            }

            $success = $this->model->editService($data);

            if ($success) {
                return $res->json(['success' => true]);
            }

            return $res->json(['error' => 'Cập nhật thất bại'], 400);
        } catch (\Throwable $e) {
            return $res->json(['error' => $e->getMessage()], 500);
        }
    }


    // Xoá
    public function delete(Request $req, $res)
    {
        $id = $req->param('id');
        $success = $this->model->deleteService($id);

        if ($success) {
            return $res->json(['success' => true, 'message' => 'Xóa dịch vụ thành công'])->send();
        }

        return $res->json(['error' => 'Xoá thất bại'], 400)->send();
    }
}
