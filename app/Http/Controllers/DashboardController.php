<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'kasir') {
            return view('dashboard.kasir');
        }

        $produk = Product::count();
        $kategori = Category::count();
        $supplier = Supplier::count();
        $today = now();
        $penjualan = Sale::whereDate('created_at', $today)->count();

        $startDate = $today->copy()->subDays(6)->startOfDay();
        $endDate = $today->copy()->endOfDay();

        $salesByDay = Sale::selectRaw('DATE(created_at) as date, SUM(total) as total_sales')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total_sales', 'date')
            ->toArray();

        $salesChartLabels = [];
        $salesChartValues = [];

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $salesChartLabels[] = $date->format('d M');
            $salesChartValues[] = isset($salesByDay[$date->toDateString()]) ? (float) $salesByDay[$date->toDateString()] : 0;
        }

        return view('dashboard', compact('produk', 'kategori', 'supplier', 'penjualan', 'salesChartLabels', 'salesChartValues'));
    }
}