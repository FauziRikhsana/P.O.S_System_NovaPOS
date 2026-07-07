<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $salesQuery = Sale::with('user')->latest();

        if ($startDate) {
            $salesQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $salesQuery->whereDate('created_at', '<=', $endDate);
        }

        $sales = $salesQuery->get();

        $summary = [
            'transactions' => $sales->count(),
            'total_sales' => $sales->sum('total'),
            'total_paid' => $sales->sum('paid'),
            'total_change' => $sales->sum('change'),
        ];

        return view('reports.index', compact('sales', 'summary', 'startDate', 'endDate'));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $salesQuery = Sale::with('user')->latest();

        if ($startDate) {
            $salesQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $salesQuery->whereDate('created_at', '<=', $endDate);
        }

        $sales = $salesQuery->get();
        $summary = [
            'transactions' => $sales->count(),
            'total_sales' => $sales->sum('total'),
            'total_paid' => $sales->sum('paid'),
            'total_change' => $sales->sum('change'),
        ];

        $html = view('reports.pdf', compact('sales', 'summary', 'startDate', 'endDate'))->render();

        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        $filename = 'laporan-penjualan-' . now()->format('YmdHis') . '.pdf';

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $salesQuery = Sale::with('user')->latest();

        if ($startDate) {
            $salesQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $salesQuery->whereDate('created_at', '<=', $endDate);
        }

        $sales = $salesQuery->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Laporan Penjualan');
        $sheet->setCellValue('A2', 'Periode');
        $sheet->setCellValue('B2', $startDate . ' s/d ' . $endDate);

        $rows = [
            ['No', 'Invoice', 'Kasir', 'Tanggal', 'Metode', 'Total', 'Bayar', 'Kembalian'],
        ];

        foreach ($sales as $index => $sale) {
            $rows[] = [
                $index + 1,
                $sale->invoice,
                $sale->user->name ?? '-',
                $sale->created_at->format('d-m-Y H:i'),
                ucfirst($sale->payment_method ?? 'cash'),
                number_format($sale->total, 2, '.', ''),
                number_format($sale->paid, 2, '.', ''),
                number_format($sale->change, 2, '.', ''),
            ];
        }

        $sheet->fromArray($rows, null, 'A4');

        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $fileName = 'laporan-penjualan-' . now()->format('YmdHis') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), 'report');

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->file($tempFile, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ])->deleteFileAfterSend(true);
    }
}
