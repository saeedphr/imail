<?php

namespace saeedphr\imail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use saeedphr\imail\imail;

class ImailController extends Controller
{
    public function index()
    {
        return Imail::getInbox(1);
    }

    public function show($count=1)
    {
        if(empty($count) || !is_numeric($count) || $count<1)
            $count=1;
        return Imail::getInbox($count);
    }
    



}
