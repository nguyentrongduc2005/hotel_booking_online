<?php

namespace app\models;

use app\core\db;
use DateTime;

class ListRoomModel
{
    public function __construct()
    {
        db::connect();
    }

    public function getFilteredRooms($filters)
    {
        if (!empty($filters['check_in'])) {
            $dt = new DateTime($filters['check_in']);
            $filters['check_in'] = $dt->format('Y-m-d H:i:s');
        }

        if (!empty($filters['check_out'])) {
            $dt = new DateTime($filters['check_out']);
            $filters['check_out'] = $dt->format('Y-m-d H:i:s');
        }
        // echo "<pre>";
        // print_r($filters);
        // echo "</pre>";
        $where = [];
        $params = [];

        $allowedRoomColumns = ['status', 'id_room_type', 'amount_bed', 'capacity', 'area', 'price'];
        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                switch ($key) {
                    case 'price_range':
                        [$min, $max] = explode('-', $value);
                        $where[] = "room.price BETWEEN :minPrice AND :maxPrice";
                        $params['minPrice'] = (float)$min;
                        $params['maxPrice'] = (float)$max;
                        break;
                    case 'room_type':
                        $where[] = "room_type.name_type_room = :room_type";
                        $params['room_type'] = $value;
                        break;
                    case 'area_range':
                        [$min, $max] = explode('-', $value);
                        $where[] = "room.area BETWEEN :minArea AND :maxArea";
                        $params['minArea'] = (float)$min;
                        $params['maxArea'] = (float)$max;
                        break;
                    case 'guest_count':
                        $where[] = "room.capacity >= :guest_count";
                        $params['guest_count'] = (int)$value;
                        break;
                    case 'bed_count':
                        $where[] = "room.amount_bed = :bed_count";
                        $params['bed_count'] = (int)$value;
                        break;
                    // Bỏ qua các key không phải cột room
                    case 'check_in':
                    case 'check_out':
                        break;
                    default:
                        if (in_array($key, $allowedRoomColumns)) {
                            $where[] = "room.$key = :$key";
                            $params[$key] = $value;
                        }
                        break;
                }
            }
        }

        // Lọc theo ngày check-in và check-out
        if (!empty($filters['check_in']) && !empty($filters['check_out'])) {
            $where[] = "room.id_room NOT IN (
                SELECT id_room FROM booking 
                WHERE (:check_in < check_out AND :check_out > check_in)
            )";
            $params['check_in'] = $filters['check_in'];
            $params['check_out'] = $filters['check_out'];
        }

        // Nếu không có điều kiện nào, trả về tất cả phòng không bị đặt
        if (empty($where)) {
            $where[] = "room.id_room NOT IN (
                SELECT id_room FROM booking 
                WHERE CURDATE() < check_out
            )";
        }


        $sql = "SELECT room.id_room, room.price, room.status, room.slug, room.area, room.thumb, 
                       room.description, room.amount_bed, room.capacity, room_type.name_type_room
                FROM room
                INNER JOIN room_type ON room.id_room_type = room_type.id_type_room
                WHERE " . implode(" AND ", $where);

        $data = db::getAll($sql, $params);
        return $data ?: [];
    }
}