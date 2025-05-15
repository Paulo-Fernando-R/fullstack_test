<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $user = User::paginate(10);

        return ProductResource::collection($user);

    }
}
