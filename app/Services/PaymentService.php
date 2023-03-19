<?php

namespace App\Services;


use App\Helpers\Util;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function __construct(private Invoice $model)
    {
    }

    public function list($request)
    {
        $query = $this->model->query();

        if ($request->filled('month')) {
            $query->whereRaw("DATE_FORMAT(scheduled_payment_date, '%Y-%m') = ?", [date("Y-m")]);
        }
        return $query->get();
    }

    public function create($data)
    {
        return DB::transaction(function () use ($data) {
            $dataUpload = (new UploadService())->upload($data['file']);
            $attachment = (new AttachmentService())->create($dataUpload['hash'], $dataUpload['path']);
            $data = (new Invoice())->create([
                'name' => $data['name'],
                'value' => Util::formatMoedaBD($data['value']),
                'scheduled_payment_date' => Util::formatDataBD($data['scheduled_payment_date']),
                'category_id' => intval($data['category_id']),
                'recurrence_id' => intval($data['recurrence_id']),
                'attachment_id' => $attachment->id,
                'user_id' => $data['payload']['user_id'],
            ]);
            return $data;
        });
    }

    public function destroy($id)
    {
        # policy
        # deleting
        # return bool
    }
}
