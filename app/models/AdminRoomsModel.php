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

    public function getAllRooms($searchName = null)
    {
        $sql = "SELECT room.id_room, room.name, room.slug, room.price, room.status ,room.area ,room.capacity ,room_type.name_type_room,room.id_room_type, COUNT(room_amenity.amenity_id) AS amenity_count FROM room
                INNER JOIN room_type on room.id_room_type = room_type.id_type_room
                LEFT JOIN room_amenity on room.id_room = room_amenity.id_room";
        $params = [];
        if ($searchName) {
            $sql .= " WHERE room.name LIKE :name";
            $params['name'] = '%' . $searchName . '%';
        }
        $sql .= " GROUP BY room.id_room;";
        $data = db::getAll($sql, $params);
        return $data ? $data : [];
    }

    public function getDataByFilter($filter)
    {
        $condition = "";
        $params = [];
        foreach ($filter as $key => $value) {
            if (!empty($value)) {
                if ($condition != "") {
                    $condition .= " AND ";
                }
                if ($key == "capacity" || $key == "area") {
                    $condition .= "room.$key >= :$key";
                    $params[$key] = $value;
                } else if ($key == "slug") {
                    $condition .= "room.$key LIKE CONCAT('%', :$key, '%')";
                    $params[$key] = $value;
                } else {
                    $condition .= "room.$key = :$key";
                    $params[$key] = $value;
                }
            }
        }
        $sql = "SELECT room.id_room, room.name, room.slug, room.price, room.status ,room.area ,room.capacity ,room_type.name_type_room,room.id_room_type, COUNT(room_amenity.amenity_id) AS amenity_count FROM room
                INNER JOIN room_type on room.id_room_type = room_type.id_type_room
                LEFT JOIN room_amenity on room.id_room = room_amenity.id_room
                GROUP BY room.id_room";
        if ($condition) {
            $sql .= " HAVING $condition";
        }
        $data = db::getAll($sql, $params);
        return $data ? $data : [];
    }
    function getNameRoomTypes()
    {
        $sql = "SELECT * FROM room_type";
        $data = db::getAll($sql);
        return $data ? $data : [];
    }

    function getImagesByRoomId($id_room)
    {
        $sql = "SELECT id_image, path FROM image_room WHERE id_room = :id_room";
        $data = db::getAll($sql, ['id_room' => $id_room]);
        return $data ? $data : [];
    }

    function getAllAmenities()
    {
        $sql = "SELECT name AS amenity_name, amenity_id, description as description_amenity FROM amenity";
        $data = db::getAll($sql);
        return $data ? $data : [];
    }

    function addRoom($data)
    {
        //add dữ liệu vào bảng room
        $id = db::insert('room', [
            'slug' => $data['slug'],
            'name' => $data['name'] ?? '', // Thêm tên phòng nếu có
            'description' => $data['description'] ?? '', // Thêm mô tả nếu có
            "amount_bed" => $data['amount_bed'] ?? 0, // Thêm số lượng giường nếu có
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

    function editRoom($data)
    {
        // Lọc dữ liệu để loại bỏ các trường không cần thiết


        // Cập nhật thông tin phòng
        $row = db::update('room', [
            'slug' => $data['slug'],
            'name' => $data['name'] ?? '', // Thêm tên phòng nếu có
            'description' => $data['description'] ?? '', // Thêm mô tả nếu có
            "amount_bed" => $data['amount_bed'] ?? 0, // Thêm số lượng giường nếu có
            'price' => $data['price'],
            'status' => $data['status'],
            'area' => $data['area'],
            'capacity' => $data['capacity'],
            'id_room_type' => $data['id_room_type']
        ], "id_room = {$data['id_room']}");
        if (!$row) {
            return false; // Trả về false nếu không thể cập nhật phòng
        }

        // Cập nhật tiện nghi
        if (!empty($data['amenities'])) {
            db::delete('room_amenity', "id_room = {$data['id_room']}"); // Xóa tất cả tiện nghi hiện tại
            foreach ($data['amenities'] as $amenity_id) {
                db::insert('room_amenity', [
                    'id_room' => $data['id_room'],
                    'amenity_id' => $amenity_id
                ]);
            }
        }

        // Cập nhật ảnh phòng
        if (!empty($data['delete_images'])) {
            foreach ($data['delete_images'] as $image_id) {
                $Pimage = db::getOne("SELECT path FROM image_room WHERE id_image = :id_image", ['id_image' => $image_id]);

                $filePath = __DIR__ . '/../../public' . $Pimage['path'];
                if ($Pimage && file_exists($filePath)) {
                    unlink($filePath);
                }
                db::delete('image_room', "id_image = $image_id");
            }
        }

        if (!empty($data['new_images'])) {
            $isFlag = false; // Biến cờ để kiểm tra xem có ảnh nào được upload hay không
            foreach ($_FILES['new_images']['name'] as $index => $name) {
                if ($_FILES['new_images']['error'][$index] === 0) {
                    $tmpName = $_FILES['new_images']['tmp_name'][$index];
                    $name = uniqid() . '-' . basename($name); // Tạo tên duy nhất cho ảnh
                    $fullPath = __DIR__ . '/../../public/assets/img/room/' . $name; // Đường dẫn lưu ảnh
                    if (move_uploaded_file($tmpName, $fullPath)) {
                        db::insert('image_room', [
                            'id_room' => $data['id_room'],
                            'path' => "/img/room/" . $name
                        ]);
                        if (!$isFlag) {
                            $row = db::update('room', [
                                'thumb' => "/img/room/" . $name
                            ], "id_room = {$data['id_room']}");
                            if ($row) $isFlag = true;  // Đặt cờ nếu ít nhất một ảnh được upload thành công
                        }
                    }
                }
            }
        }

        return true;
    }

    function deleteRoom($id_room)
    {
        // Xóa ảnh liên quan đến phòng
        $images = db::getAll("SELECT path FROM image_room WHERE id_room = :id_room", ['id_room' => $id_room]);
        foreach ($images as $image) {
            $filePath = dirname(__DIR__, 2) . '/public/assets' . $image['path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            } else {
                return false;
            }
        }
        db::delete('image_room', "id_room = $id_room");
        // Xóa tiện nghi liên quan đến phòng
        db::delete('room_amenity', "id_room = $id_room");

        // Xóa phòng
        $row = db::delete('room', "id_room = $id_room");
        return $row ? true : false;
    }


    function addTypeRoom($data)
    {
        $id = db::insert('room_type', [
            'name_type_room' => $data['name_type_room'],
            'description' => $data['description'] ?? '' // Thêm mô tả nếu có
        ]);
        return $id ? true : false;
    }

    function editTypeRoom($data)
    {
        $filtered = array_filter($data, function ($value) {
            return !(
                $value === '' ||
                $value === null ||
                (is_array($value) && empty($value))
            );
        });
        $row = db::update('room_type', $filtered, "id_type_room = {$data['id_type_room']}");
        return $row ? true : false;
    }

    function deleteTypeRoom($id_type_room)
    {
        $row = db::delete('room_type', "id_type_room = $id_type_room");
        return $row ? true : false;
    }

    function addAmenities($data)
    {
        $id = db::insert('amenity', [
            'name' => $data['name'],
            'description' => $data['description'] ?? '' // Thêm mô tả nếu có
        ]);
        return $id ? true : false;
    }

    function editAmenities($data)
    {
        $filtered = array_filter($data, function ($value) {
            return !(
                $value === '' ||
                $value === null ||
                (is_array($value) && empty($value))
            );
        });
        $row = db::update('amenity', $filtered, "amenity_id = {$data['amenity_id']}");
        return $row ? true : false;
    }

    function deleteAmenities($id_amenity)
    {
        $row = db::delete('amenity', "amenity_id = $id_amenity");
        return $row ? true : false;
    }
}
