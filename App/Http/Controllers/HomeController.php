<?php

namespace App\Http\Controllers;

use Models\Product;
use Trait\uploadFile;
use View\View;

class HomeController
{
    private $productModel = null;
    private $rules = [];
    private $messages = [];
    use uploadFile;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->rules = [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ];
        $this->messages = [
            'name.required' => 'name không được để trống',
            'price.required' => 'price không được để trống',
            'description.required' => 'description không được để trống',
        ];
    }

    public function index()
    {
        if (!empty($_SESSION['alert'])) {
            $alert = $_SESSION['alert'];
            unset($_SESSION['alert']);
        }
        $products = $this->productModel->get();
        View::render('home/index.php', ['products' => $products, 'alert' => $alert ?? null]);
    }

    public function create()
    {
        if (!empty($_SESSION['dataForm'])) {
            $dataFormOld = $_SESSION['dataForm'];
            unset($_SESSION['dataForm']);
        }
        if (!empty($_SESSION['erorrs'])) {
            $erorrs = $_SESSION['erorrs'];
            unset($_SESSION['erorrs']);
        }
        View::render('home/create.php', ['dataFormOld' => $dataFormOld ?? null, 'erorrs' => $erorrs ?? null]);
    }

    public function store()
    {
        if (!empty($_SESSION['erorrs'])) {
            unset($_SESSION['erorrs']);
        }
        if (!empty($_SESSION['alert'])) {
            unset($_SESSION['alert']);
        }
        $rules = $this->rules;
        $messages = $this->messages;
        $dataForm = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price']
        ];
        $image = !empty($_FILES["image"]["name"]) ? $this->uploadImage('image') : null;
        if (!empty($image)) {
            $dataForm['image'] = $image;
        }
        $validateService = new \ValidateService($dataForm);
        $validateService->setRules($rules);
        $validateService->setMessages($messages);
        $validateService->validate();
        if ($validateService->countErorrs()) {
            $erorrs = $validateService->getErrors();
            $_SESSION['erorrs'] = $erorrs;
            $_SESSION['dataForm'] = $dataForm;
            header("Location: /product/add");
            exit();
        }
        $id = $this->productModel->insert($dataForm);
        $alert = !empty($id) ? ['message' => 'Thêm sản phẩm thành công!', 'type' => 'success'] : ['message' => 'Thêm sản phẩm không thành công!', 'type' => 'danger'];
        $_SESSION['alert'] = $alert;
        header("Location: /product");
    }

    public function edit()
    {
        if (!empty($_SESSION['erorrs'])) {
            $erorrs = $_SESSION['erorrs'];
            unset($_SESSION['erorrs']);
        }
        $id = $_GET['id'];
        $data = $this->productModel->find($id);
        View::render('home/edit.php', ['data' => $data, 'erorrs' => $erorrs]);
    }

    public function update()
    {
        if (!empty($_SESSION['erorrs'])) {
            unset($_SESSION['erorrs']);
        }
        if (!empty($_SESSION['alert'])) {
            unset($_SESSION['alert']);
        }
        $idProduct = $_GET['id'];
        $rules = $this->rules;
        $messages = $this->messages;
        $dataForm = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
        ];
        $image = !empty($_FILES["image"]["name"]) ? $this->uploadImage('image') : null;
        if (!empty($image)) {
            $dataForm['image'] = $image;
        }
        $validateService = new \ValidateService($dataForm);
        $validateService->setRules($rules);
        $validateService->setMessages($messages);
        $validateService->validate();
        if ($validateService->countErorrs()) {
            $erorrs = $validateService->getErrors();
            $_SESSION['erorrs'] = $erorrs;
            header("Location: /product/edit?id=" . $idProduct);
            exit();
        }
        $id = $this->productModel
            ->where('id', $idProduct)
            ->update($dataForm);
        $alert = !empty($id) ? ['message' => 'Cập nhật sản phẩm thành công!', 'type' => 'success'] : ['message' => 'Cập nhật sản phẩm không thành công!', 'type' => 'danger'];
        $_SESSION['alert'] = $alert;
        header("Location: /product");
    }

    public function delete()
    {
        $idProduct = $_GET['id'];
        $id = $this->productModel
            ->where('id', $idProduct)
            ->delete();
        $alert = !empty($id) ? ['message' => 'Xóa sản phẩm thành công!', 'type' => 'success'] : ['message' => 'Xóa sản phẩm không thành công!', 'type' => 'danger'];
        $_SESSION['alert'] = $alert;
        header("Location: /product");
    }

}
