<?php

namespace App\Services\Admin\TestConnection;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\MobileConnection;
use App\Models\Admin\Capture;
use App\Services\BaseService;

class PostConnectionService extends BaseService
{
    public function execute($params)
    {
        $conn = MobileConnection::create([
            'id_number' => $params['id_number'],
            'status' => 1
        ]);

        $capture = Capture::where(['captured_by'=>$params['id_number']]) 
        ->orderBy('created_at', 'desc')
        ->get();

        return [
            'connection' => [
                'id_number'=>$conn->id_number,
                'status'=>$conn->status,
                'created_at'=>$conn->created_at->toDateTimeString(),
            ],
            'encoded_payroll' => [
                'payroll_count' => count($capture),
                'payroll' => $this->getCapture($params['id_number'])
            ]
        ];

    }
}
