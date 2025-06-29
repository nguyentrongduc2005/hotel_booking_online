<?php

namespace app\models;

use app\core\db;

class DashboardModel
{

    private $total;
    private $available;
    private $maintenance;
    private $Ncheckin;
    private $Ncheckout;
    private $NBookingToday;

    public function __construct()
    {
        db::connect();
        $this->getinfoDashBoard();
        $this->getInOutAndBookingToday();

        // Initialize the model if needed
    }
    public function getTotal()
    {
        return $this->total;
    }

    public function getAvailable()
    {
        return $this->available;
    }

    public function getMaintenance()
    {
        return $this->maintenance;
    }

    public function getNcheckin()
    {
        return $this->Ncheckin;
    }

    public function getNcheckout()
    {
        return $this->Ncheckout;
    }

    public function getNBookingToday()
    {
        return $this->NBookingToday;
    }

    function getinfoDashBoard()
    {
        $sql = "SELECT id_room, status FROM `room`;";
        $data = db::getAll($sql);
        // $countValues = array_count_values($data);

        foreach ($data as $item) {
            if ($item["status"] == "maintenance") $this->maintenance++;
            if ($item["status"] == "available") $this->available++;
        }
        $this->total = count($data);
    }



    function getInOutAndBookingToday()
    {
        $sql = "SELECT booking.check_in,booking.status_checkout,booking.status_checkin, booking.check_out , booking.created_at FROM `booking` WHERE booking.status = 'confirmed';";
        $data = db::getAll($sql);
        $this->Ncheckin = 0;
        $this->Ncheckout = 0;
        $this->NBookingToday = 0;
        foreach ($data as $item) {
            $daycheckin = date('Y-m-d', strtotime($item['check_in']));

            $daycheckout = date('Y-m-d', strtotime($item['check_out']));
            $createdAt = date('Y-m-d', strtotime($item['created_at']));


            $now = (date('Y-m-d'));
            if ($daycheckin === $now && $item['status_checkin'] == 'pending') {
                $this->Ncheckin++;
            }
            if ($daycheckout == $now && $item['status_checkout'] == 'pending' && $item['status_checkin'] == 'done') {
                $this->Ncheckout++;
            }
            if ($createdAt == $now) {

                $this->NBookingToday++;
            }
        }
    }


    function getListBookingPending()
    {
        $sql = "SELECT 
         b.id_booking,
            u.full_name  AS full_name_user,
            u.email      AS full_email_user,
            g.full_name  AS full_name_guest,
            g.email      AS full_email_guest,
            b.id_booking,
            b.check_in,
            b.check_out,
            b.id_room
            FROM booking AS b
            LEFT JOIN user  AS u ON b.user_id  = u.user_id    -- giữ dòng dù user_id NULL
            LEFT JOIN guest AS g ON b.guest_id = g.guest_id   -- giữ dòng dù guest_id NULL
            WHERE b.status = 'pending';";

        $data = db::getAll($sql);
        return $data ? $data : [];
    }

    function updataConformBooking($id,  $status)
    {
        if ($status == 'cancelled') {
            $rowSuccess = db::update('booking', [
                "status" => 'cancelled',
            ], $id);
            if ($rowSuccess > 0) return true;
            return false;
        }
        $rowSuccess = db::update('booking', [
            "status" => 'confirmed',
        ], $id);
        if ($rowSuccess > 0) return true;
        return false;
    }

    function getListCheckinToday()
    {

        $sql = "SELECT 
        b.id_booking,
            g.full_name  AS full_name_guest,
            g.email      AS full_email_guest,
            u.full_name  AS full_name_user,
            u.email      AS full_email_user,
            TIME(b.check_in) AS checkin_time,
            r.id_room,
            r.slug AS room_slug
            FROM booking AS b
            LEFT JOIN guest  AS g ON b.guest_id  = g.guest_id
            LEFT JOIN user  AS u ON b.user_id  = u.user_id
            LEFT JOIN room  AS r ON b.id_room  = r.id_room
            WHERE b.status = 'confirmed' AND b.status_checkin = 'pending' AND DATE(b.check_in) = CURDATE();";

        $data = db::getAll($sql);

        return $data ? $data : [];
    }

    function updateCheckinBooking($id)
    {
        $rowSuccess = db::update('booking', [
            "status_checkin" => 'done',
        ], $id);
        if ($rowSuccess > 0) return true;
        return false;
    }


    function getListCheckoutToday()
    {

        $sql = "SELECT 
         b.id_booking,
            g.full_name  AS full_name_guest,
            g.email      AS full_email_guest,
            u.full_name  AS full_name_user,
            u.email      AS full_email_user,
            r.id_room,
            r.slug AS room_slug
            FROM booking AS b
            LEFT JOIN guest  AS g ON b.guest_id  = g.guest_id
            LEFT JOIN user  AS u ON b.user_id  = u.user_id
            LEFT JOIN room  AS r ON b.id_room  = r.id_room
            WHERE b.status = 'confirmed' AND b.status_checkout = 'pending' AND b.status_checkin = 'done' AND DATE(b.check_out) = CURDATE();";

        $data = db::getAll($sql);

        return $data ? $data : [];
    }

    function updateCheckoutBooking($id)
    {
        $rowSuccess = db::update('booking', [
            "status_checkout" => 'done',
        ], $id);
        if ($rowSuccess > 0) return true;
        return false;
    }

    function updateDataHistory($id, $status)
    {
        $condition = '';
        if ($status == "completed") {
            $condition = "AND (booking.status_checkin = 'done' AND booking.status_checkout  = 'done')";
        } else if ($status == "cancelled") {
            $condition = "AND booking.status = 'cancelled'";
        }
        $sql = "SELECT 
                user_id,
                guest_id,
                check_in,
                check_out,
                created_at,
                transaction_id,
                id_room
                FROM booking Where id_booking = :id $condition";
        $booking_old =  db::getOne($sql, ["id" => $id]);
        if (!$booking_old) return false;
        $data = db::insert('historybooking', [
            "user_id" => $booking_old['user_id'],
            "guest_id" => $booking_old['guest_id'],
            "check_in" => $booking_old['check_in'],
            "check_out" => $booking_old['check_out'],
            "created_at" => $booking_old['created_at'],
            "transaction_id" => $booking_old['transaction_id'],
            "id_room" => $booking_old['id_room'],
            "status" => $status
        ]);
        if (!isset($data)) return false;
        $row = db::delete('booking', "id_booking = $id");
        if (!$row) return false;
        return true;
    }
}
