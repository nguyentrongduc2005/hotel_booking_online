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
        $id = db::insert('services', [
            'name' => $data['name'],
            'description' => $data['description'] ?? ''
        ]);
        return $id ? true : false;
    }

    // Sửa
    public function editService($data)
    {
        $filtered = array_filter($data, function ($value) {
            return !(
                $value === '' ||
                $value === null ||
                (is_array($value) && empty($value))
            );
        });

        $row = db::update('services', $filtered, "id_service = {$data['id_service']}");
        return $row ? true : false;
    }

    // Xoá
    public function deleteService($id_service)
    {
        $row = db::delete('services', "id_service = $id_service");
        return $row ? true : false;
    }
}
