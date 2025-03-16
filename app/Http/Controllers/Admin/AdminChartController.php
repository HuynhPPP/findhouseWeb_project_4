<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminChartController extends Controller
{
  public function PostChart()
  {
    $posts = Post::select(
      DB::raw("MONTH(created_at) as month"),
      DB::raw("COUNT(*) as count")
    )
      ->groupBy('month')
      ->orderBy('month')
      ->get();
    $labels = $posts->pluck('month')->map(function ($month) {
      return "Tháng " . $month;
    });

    return response()->json([
      'labels' => $labels,
      'counts' => $posts->pluck('count'),
    ]);
  }
  public function userStatistics()
  {
    $users = DB::table('users')
      ->select(DB::raw('COUNT(id) as count'), DB::raw('MONTH(created_at) as month'))
      ->whereYear('created_at', date('Y')) // Chỉ lấy trong năm hiện tại
      ->groupBy('month')
      ->orderBy('month')
      ->get();
    // Định dạng dữ liệu cho biểu đồ
    $labels = [];
    $data = [];
    for ($i = 1; $i <= 12; $i++) {
      $labels[] = "Tháng " . $i;
      $data[] = $users->firstWhere('month', $i)->count ?? 0;
    }
    return response()->json([
      'labels' => $labels,
      'data' => $data
    ]);
  }
}
