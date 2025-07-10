<?php

namespace app\models;

use app\core\db;

class AdminServicesModel
{
    public function __construct()
    {
        db::connect();
    }

    // Lấy tất cả dịch vụ, tìm theo tên
    public function getAllServices($searchName = null)
    {
        $sql = "SELECT * FROM services";
        $params = [];

        if (!empty($searchName)) {
            $sql .= " WHERE name LIKE :name";
            $params['name'] = '%' . $searchName . '%';
        }

        $sql .= " ORDER BY id_service DESC";

        return db::getAll($sql, $params) ?: [];
    }

    // Thêm dịch vụ mới
    public function addService($data)
    {
        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $data['name']), '-'));

        $insertData = [
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'] ?? '',
            'Path_img' => $data['Path_img'] ?? null, // ✅ lấy từ controller
        ];

        return db::insert('services', $insertData) ? true : false;
    }

    // Lấy 1 service theo id
    public function getServiceById($id_service)
    {
        return db::getOne("SELECT * FROM services WHERE id_service = :id_service", [
            'id_service' => $id_service
        ]);
    }

    // Cập nhật
    public function editService($data)
    {
        $fields = ['name', 'description', 'Path_img'];
        $updateData = [];

        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $updateData[$field] = $data[$field];
            }
        }

        return db::update('services', $updateData, "id_service = {$data['id_service']}") ? true : false;
    }

    // Xoá
    public function deleteService($id_service)
    {
        $service = $this->getServiceById($id_service);
        if ($service && $service['Path_img'] && file_exists('public/assets' . $service['Path_img'])) {
            @unlink('public/assets' . $service['Path_img']);
        }

        return db::delete('services', "id_service = $id_service") ? true : false;
    }
}
