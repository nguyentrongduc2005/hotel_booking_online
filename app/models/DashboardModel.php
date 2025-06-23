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
        $this->getInOutAndBookingTodat();
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



    function getInOutAndBookingTodat()
    {
        $sql = "SELECT booking.check_in, booking.check_out , booking.created_at FROM `booking` WHERE booking.status = 'confirmed';";
        $data = db::getAll($sql);
        $this->Ncheckin = 0;
        $this->Ncheckout = 0;
        $this->NBookingToday = 0;
        foreach ($data as $item) {
            $daycheckin = date('Y-m-d', strtotime($item['check_in']));

            $daycheckout = date('Y-m-d', strtotime($item['check_out']));
            $createdAt = date('Y-m-d', strtotime($item['created_at']));


            $now = (date('Y-m-d'));
            if ($daycheckin === $now) {
                $this->Ncheckin++;
            }
            if ($daycheckout == $now) {
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

    function updataConformBooking($id)
    {
        $rowSuccess = db::update('booking', [
            "status" => 'confirmed',
        ], $id);
        if ($rowSuccess > 0) return true;
        return false;
    }
}
