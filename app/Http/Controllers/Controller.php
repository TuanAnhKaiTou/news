<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $limit = 25;
    protected $msgStore = [
        'suc'   => 'Create successful',
        'err'   => 'Have error while creating'
    ];
    protected $msgUpdate = [
        'suc'   => 'Update successful',
        'err'   => 'Have error while updating'
    ];
}
