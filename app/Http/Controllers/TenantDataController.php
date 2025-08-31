<?php 
namespace App\Http\Controllers;

class TenantDataController extends Controller
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
