<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    private Group $model;

    public function __construct()
    {
        $this->model = new Group();
    }

    public function list($filters = null)
    {
        return $this->model->all();
    }

    public function create($data)
    {
        $group = $this->model->create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        if (!$group) {
            throw new Exception('Erro ao criar grupo.');
        }

        return $group;
    }
}
