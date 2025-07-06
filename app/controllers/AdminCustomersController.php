<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\AdminCustomersModel;

class AdminCustomersController extends Controller
{
    private $model;

    public     function __construct()
    {
        parent::__construct();
        $this->model = new AdminCustomersModel();
        // Set viewpathComponent to /admin for admin controllers
        self::setcomponent('/admin');
        self::setLayout('AdminLayouts/main');
    }

    public function index(Request $req, $res)
    {
        $search = $req->query('search');

        $users = $this->model->getAllUsers($search);
        $guests = $this->model->getAllGuests($search);

        return $this->render('customers', [
            'users' => $users,
            'guests' => $guests,
            'search' => $search
        ]);
    }

    // Method for users page
    public function users(Request $req, $res)
    {
        $search = $req->query('search');
        $users = $this->model->getAllUsers($search);

        self::setcomponent('/admin');
        self::setLayout('AdminLayouts/main');

        return $this->render('users', [
            'users' => $users,
            'search' => $search
        ]);
    }

    // Method for guests page
    public function guests(Request $req, $res)
    {
        $search = $req->query('search');
        $guests = $this->model->getAllGuests($search);

        // Đặt lại component view và layout cho admin
        self::setcomponent('/admin');
        self::setLayout('AdminLayouts/main');

        // Render đúng view 'guests' (không thêm đường dẫn dài)
        return $this->render('guests', [
            'guests' => $guests,
            'search' => $search
        ]);
    }

    // Xoá user
    public function deleteUser(Request $req, $res)
    {
        $id = $req->param('id');
        $result = $this->model->deleteUser($id);

        return $res->json([
            'success' => $result,
            'message' => $result ? 'Xoá user thành công' : 'Xoá user thất bại'
        ]);
    }

    // Xoá guest
    public function deleteGuest(Request $req, $res)
    {
        $id = $req->param('id');
        $result = $this->model->deleteGuest($id);

        return $res->json([
            'success' => $result,
            'message' => $result ? 'Xoá guest thành công' : 'Xoá guest thất bại'
        ]);
    }
}
