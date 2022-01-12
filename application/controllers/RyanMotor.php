<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');


class RyanMotor extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RyanMotor_model');
    }

    public function index_get()
    {
        $nama = $this->get('nama');

        if ($nama === null) {
            $nama = $this->RyanMotor_model->getRyanMotor();
        } else {
            $nama = $this->RyanMotor_model->getRyanMotor($nama);
        }

        if ($nama) {
            $this->response([
                'status' => true,
                'message' => $nama
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => $nama . ' tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $nama = $this->delete('nama');

        if ($nama === null) {
            $this->response([
                'status' => false,
                'message' => 'permintaan ini membutuhkan nama'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->RyanMotor_model->deleteRyanMotor($nama) > 0) {
                $this->response([
                    'status' => true,
                    'nama' => $nama,
                    'message' => 'berhasil dihapus'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'nama tidak ada yang cocok'
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'gambar' => $this->post('gambar'),
            'harga' => $this->post('harga'),
        ];

        if ($this->RyanMotor_model->createRyanMotor($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'berhasil menambahkan data'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan data'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $nama = $this->put('nama');
        $data = [
            'nama' => $this->put('nama'),
            'gambar' => $this->put('gambar'),
            'harga' => $this->put('harga'),
        ];

        if ($this->RyanMotor_model->updateRyanMotor($data, $nama) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data gagal diubah'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
