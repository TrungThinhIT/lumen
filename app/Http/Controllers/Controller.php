<?php

namespace App\Http\Controllers;

use App\Traits\Respondable;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use Respondable;
}
