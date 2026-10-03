<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts_count'       => Post::count(),
            'pages_count'       => Page::count(),
            'subscribers_count' => Subscriber::where('status', 'active')->count(),
        ];

        $latestSubscribers = Subscriber::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestSubscribers'));
    }
}
