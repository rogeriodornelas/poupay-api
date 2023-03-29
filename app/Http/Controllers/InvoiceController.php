<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\CreateRequest;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Exception;

class InvoiceController extends Controller
{
    public function __construct(private InvoiceService $service)
    {
    }

    public function list(Request $request)
    {
        try {
            $data = $this->service->list($request);
            return response()->json($data);
        } catch (Exception $ex) {
            return response()->json([
                'message' => "Falha ao listar pagamentos",
                'log' => $ex->getMessage(),
            ], 400);
        }
    }

    public function create(CreateRequest $request)
    {
        try {
            $data = $this->service->create($request->all());
            return response()->json([
                'message' => "Pagamento cadastrado com sucesso",
                'data' => $data,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'message' => "Falha ao cadastrar pagamento",
                'log' => $ex->getMessage(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        //
    }
}
