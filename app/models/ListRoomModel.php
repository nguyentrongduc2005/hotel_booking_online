<?php

namespace app\models;

use app\core\db;

class ListRoomModel
{
    public function __construct()
    {
        db::connect();
    }

    
    public function getFilteredRooms($filters)
    {
        $condition = "";
        $params = [];

        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                if ($condition !== "") {
                    $condition .= " AND ";
                }

                switch ($key) {
                    case 'price_range':
                        // Lọc theo khoảng giá
                        [$min, $max] = explode('-', $value);
                        $condition .= "room.price BETWEEN :minPrice AND :maxPrice";
                        $params['minPrice'] = (float)$min;
                        $params['maxPrice'] = (float)$max;
                        break;

                    case 'room_type':
                        // Lọc theo tên loại phòng
                        $condition .= "room_type.name_type_room = :room_type";
                        $params['room_type'] = $value;
                        break;

                    case 'area':
                        // Diện tích phòng 
                        $condition .= "room.area >= :area";
                        $params['area'] = (int)$value;
                        break;

                    case 'guest_count':
                       // số người
                        $condition .= "room.capacity >= :guest_count";
                        $params['guest_count'] = $value;
                        break;

                    case 'bed_count':
                        // số giường
                        $condition .= "room.amount_bed = :bed_count";
                        $params['bed_count'] = (int)$value;
                        break;

                    default:
                        // Trường hợp khác
                        $condition .= "room.$key = :$key";
                        $params[$key] = $value;
                }
            }
        }

        // Kiểm tra check-in/check-out để lọc phòng không bị đặt
        if (!empty($filters['check_in']) && !empty($filters['check_out'])) {
            if ($condition !== "") {
                $condition .= " AND ";
            }

            $condition .= "room.id_room NOT IN (
                SELECT id_room FROM booking 
                WHERE (:check_in < check_out AND :check_out > check_in)
            )";

            $params['check_in'] = $filters['check_in'];
            $params['check_out'] = $filters['check_out'];
        }

        // Nếu không có bất kỳ bộ lọc nào, trả về tất cả phòng trống hiện tại
        if ($condition === "") {
            $condition = "room.id_room NOT IN (
                SELECT id_room FROM booking 
                WHERE CURDATE() < check_out
            )";
        }

        // Truy vấn dữ liệu
        $sql = "SELECT room.id_room, room.price, room.status, room.slug, room.area, room.thumb, 
                room.description, room.amount_bed,
                room_type.name_type_room
                FROM room
                INNER JOIN room_type ON room.id_room_type = room_type.id_type_room
                WHERE $condition";


        // Debug SQL và tham số (bạn có thể tắt sau khi test)
        // echo "<pre>";
        // echo "SQL:\n" . $sql . "\n";
        // echo "Params:\n";
        // print_r($params);
        // echo "</pre>";

        $data = db::getAll($sql, $params);
        
        return $data ?: [];
    }
}
