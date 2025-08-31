<?php 
namespace App\Http\Controllers;

class TenantController extends Controller
{
    public function index()
    {
        $data = tenant();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
