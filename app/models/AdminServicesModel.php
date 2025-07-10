<?php

namespace app\models;

use app\core\db;

class AdminServicesModel
{
    public function __construct()
    {
        db::connect();
    }

    // Lấy tất cả dịch vụ,tìm theo tên
    public function getAllServices($searchName = null)
    {
        $sql = "SELECT * FROM services";
        $params = [];

        if (!empty($searchName)) {
            $sql .= " WHERE name LIKE :name";
            $params['name'] = '%' . $searchName . '%';
        }

        $sql .= " ORDER BY id_service DESC";

        $data = db::getAll($sql, $params);
        return $data ? $data : [];
    }

    // Thêm
    public function addService($data)
    {
        // Debug log upload file
        file_put_contents('debug.log', date('c') . "\n" . print_r($_FILES, true), FILE_APPEND);
        $imagePath = null;
        // Xử lý upload ảnh
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'public/assets/img/service/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid('service_') . '.' . $ext;
            $targetPath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $imagePath = '/img/service/' . $fileName;
            }
        }
        // Tạo slug từ tên
        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $data['name']), '-'));
        $insertData = [
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'] ?? '',
            'Path_img' => $data['Path_img'] ?? null,
        ];
        $id = db::insert('services', $insertData);
        return $id ? true : false;
    }

    // Lấy 1 service theo id
    public function getServiceById($id_service)
    {
        return db::getOne("SELECT * FROM services WHERE id_service = :id_service", ['id_service' => $id_service]);
    }

    // Sửa
    public function editService($data)
    {
        $fields = ['name', 'description', 'Path_img'];
        $updateData = [];
        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $updateData[$field] = $data[$field];
            }
        }
        $row = db::update('services', $updateData, "id_service = {$data['id_service']}");
        return $row ? true : false;
    }

    // Xoá
    public function deleteService($id_service)
    {
        $service = $this->getServiceById($id_service);
        if ($service && $service['Path_img'] && file_exists($service['Path_img'])) {
            @unlink($service['Path_img']);
        }
        $row = db::delete('services', "id_service = $id_service");
        return $row ? true : false;
    }
}
