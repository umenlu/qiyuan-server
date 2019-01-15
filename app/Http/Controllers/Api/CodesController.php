<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodesController extends Controller
{
    public function codes()
    {
        $user = $this->user();
        $app = \EasyWeChat::miniProgram();
        $response = $app->app_code->get('pages/main/index');
            if ($response instanceof \EasyWeChat\Kernel\Http\StreamResponse) {
            $filename = $response->saveAs('/uploads/appCodes', 'appcode.png');
        }

    }
}