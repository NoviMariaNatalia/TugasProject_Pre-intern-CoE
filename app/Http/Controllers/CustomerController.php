<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $customerStatistics = CustomerStatistic::all();
        
        return view('customers.index', compact('customers', 'customerStatistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'spending' => 'required|integer|min:0',
        ]);

        Customer::create($request->all());
        
        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'spending' => 'required|integer|min:0',
        ]);

        $customer->update($request->all());
        
        return redirect()->route('customers.index')->with('success', 'Customer berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        
        return redirect()->route('customers.index')->with('success', 'Customer berhasil dihapus!');
    }

    /**
     * Import CSV file and store to customer_statistics table
     */
    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        try {
            $file = $request->file('csv_file');
            
            CustomerStatistic::truncate();

            $csvData = file($file->getRealPath());
            
            array_shift($csvData);
            
            foreach ($csvData as $row) {
                $row = trim($row);
                
                if (empty($row)) {
                    continue;
                }
                
                $data = explode(';', $row);
                
                if (count($data) >= 4) {
                    $kategori = trim($data[0]);
                    $week1 = (int) trim($data[1]);
                    $week2 = (int) trim($data[2]);
                    $week3 = (int) trim($data[3]);
                    
                    $total = $week1 + $week2 + $week3;
                    
                    CustomerStatistic::create([
                        'kategori' => $kategori,
                        'week_1' => $week1,
                        'week_2' => $week2,
                        'week_3' => $week3,
                        'total' => $total,
                    ]);
                }
            }

            return redirect()->route('customers.index')->with('success', 'Data CSV berhasil diimport!');
            
        } catch (\Exception $e) {
            return redirect()->route('customers.index')->with('error', 'Gagal import CSV: ' . $e->getMessage());
        }
    }

    /**
     * Clear all customer statistics data
     */
    public function clearStatistics()
    {
        CustomerStatistic::truncate();
        return redirect()->route('customers.index')->with('success', 'Data statistik berhasil dihapus!');
    }
}