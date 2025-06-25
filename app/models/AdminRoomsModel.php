<?php

namespace app\models;

use app\core\db;

class AdminRoomsModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }

    public function getAllRooms()
    {
        $sql = "SELECT room.slug, room.price, room.status ,room.area ,room.capacity ,room_type.name_type_room,room.id_room_type, COUNT(room_amenity.amenity_id) AS amenity_count FROM room
                INNER JOIN room_type on room.id_room_type = room_type.id_type_room
                LEFT JOIN room_amenity on room.id_room = room_amenity.id_room
                GROUP BY room.id_room;";
        $data = db::getAll($sql);
        return $data ? $data : [];
    }

    public function getDataByFilter($filter)
    {
        $condition = "";
        foreach ($filter as $key => $value) {
            if (!empty($value)) {
                if ($condition != "") {
                    $condition .= " AND ";
                }
                if ($key == "capacity" || $key == "area") {
                    $condition .= "room.$key >= :$key";
                } else if ($key == "slug") {
                    $condition .= "room.$key LIKE CONCAT('%', :$key, '%')";
                } else {
                    $condition .= "room.$key = :$key";
                }
            }
        }
        $sql = "SELECT room.slug, room.price, room.status ,room.area ,room.capacity ,room_type.name_type_room,room.id_room_type, COUNT(room_amenity.amenity_id) AS amenity_count FROM room
                INNER JOIN room_type on room.id_room_type = room_type.id_type_room
                LEFT JOIN room_amenity on room.id_room = room_amenity.id_room
                GROUP BY room.id_room WHERE $condition;";
        echo $sql;
        $data = db::getAll($sql, $filter);
        return $data ? $data : [];
    }
    function getNameRoomTypes()
    {
        $sql = "SELECT id_type_room, name_type_room FROM room_type";
        $data = db::getAll($sql);
        return $data ? $data : [];
    }

    function getAllAmenities()
    {
        $sql = "SELECT name AS amenity_name, amenity_id FROM amenity";
        $data = db::getAll($sql);
        return $data ? $data : [];
    }

    function addRoom($data)
    {
        //add dữ liệu vào bảng room
        $id = db::insert('room', [
            'slug' => $data['slug'],
            'description' => $data['description'] ?? '', // Thêm mô tả nếu có
            'price' => $data['price'],
            'status' => $data['status'],
            'area' => $data['area'],
            'capacity' => $data['capacity'],
            'id_room_type' => $data['id_room_type']
        ]);

        if (!$id) {
            return false; // Trả về false nếu không thể thêm phòng
        }
        //add dữ liệu vào bảng room_amenity nếu có

        if (!empty($data['amenities'])) {
            foreach ($data['amenities'] as $amenity_id) {
                db::insert('room_amenity', [
                    'id_room' => $id,
                    'amenity_id' => $amenity_id
                ]);
            }
        }

        //add dữ liệu vào bảng room_image nếu có
        if (!empty($data['images'])) {
            $isFlag = false; // Biến cờ để kiểm tra xem có ảnh nào được upload hay không
            foreach ($_FILES['images']['name'] as $index => $name) {
                if ($_FILES['images']['error'][$index] === 0) {
                    $tmpName = $_FILES['images']['tmp_name'][$index];
                    $name = uniqid() . '-' . basename($name); // Tạo tên duy nhất cho ảnh
                    $fullPath = __DIR__ . '/../../public/assets/img/room/' . $name; // Đường dẫn lưu ảnh
                    if (move_uploaded_file($tmpName, $fullPath)) {
                        db::insert('image_room', [
                            'id_room' => $id,
                            'path' => "/img/room/" . $name
                        ]);
                        if (!$isFlag) {
                            $row = db::update('room', [
                                'thumb' => "/img/room/" . $name
                            ], "id_room = $id");
                            if ($row) $isFlag = true;  // Đặt cờ nếu ít nhất một ảnh được upload thành công
                        }
                    }
                }
            }
        }
        return true;
    }
}
