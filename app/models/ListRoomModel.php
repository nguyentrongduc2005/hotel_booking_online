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
            $filters['check_in'] = $dt->format('Y-m-d');
        }

        if (!empty($filters['check_out'])) {
            $dt = new DateTime($filters['check_out']);
            $filters['check_out'] = $dt->format('Y-m-d');
        }

        
        $condition = "";
        $params = [];

        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                if ($condition !== "") {
                    $condition .= " AND ";
                }

                
                if ($key === 'price_range') {
                    [$min, $max] = explode('-', $value);
                    $condition .= "room.price BETWEEN :minPrice AND :maxPrice";
                    $params['minPrice'] = (float)$min;
                    $params['maxPrice'] = (float)$max;

                } elseif ($key === 'room_type') {
                    $condition .= "room_type.name_type_room = :room_type";
                    $params['room_type'] = $value;

                } elseif ($key === 'area') {
                    $condition .= "room.area >= :area";
                    $params['area'] = (int)$value;

                } elseif ($key === 'guest_count') {
                    $condition .= "room.capacity >= :guest_count";
                    $params['guest_count'] = (int)$value;

                } elseif ($key === 'bed_count') {
                    $condition .= "room.amount_bed = :bed_count";
                    $params['bed_count'] = (int)$value;

                } else {
                    $condition .= "room.$key = :$key";
                    $params[$key] = $value;
                }
            }
        }

        //lọc theo ngày check-in và check-out
        if (!empty($filters['check_in']) && !empty($filters['check_out'])) {
            if ($condition !== "") $condition .= " AND ";
            $condition .= "room.id_room NOT IN (
                SELECT id_room FROM booking 
                WHERE (:check_in < check_out AND :check_out > check_in)
            )";
            $params['check_in'] = $filters['check_in'];
            $params['check_out'] = $filters['check_out'];
        }

        // trả về all
        if ($condition === "") {
            $condition = "room.id_room NOT IN (
                SELECT id_room FROM booking 
                WHERE CURDATE() < check_out
            )";
        }

        
        $sql = "SELECT room.id_room, room.price, room.status, room.slug, room.area, room.thumb, 
                       room.description, room.amount_bed, room_type.name_type_room
                FROM room
                INNER JOIN room_type ON room.id_room_type = room_type.id_type_room
                WHERE $condition";

        $data = db::getAll($sql, $params);
        return $data ?: [];
    }
}
