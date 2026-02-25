<?php

namespace App\Http\Livewire\Dashboard\Orders;

use Livewire\Component;
use App\Models\{Order , Country , Governorate , ShippingStatus };
use App\Exports\Dashboard\Orders\OrdersExcelReportExport;
use App\Imports\Dashboard\Orders\OrdersExcelReportImport;
use Excel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class ListAllOrders extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $rows = 10;
    public $search ;
    public $shipping_status = 'all' ;
    public $start_date;
    public $end_date;
    public $file;
    public $governorate_id;
    public $country_id;

    protected $listeners = ['deleteItem'];



    public function deleteItem($item_id)
    {
        $order = Order::find($item_id);
        $order->delete();
        $this->emit('itemDeleted');
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function getGovernoratesProperty()
    {
        return Governorate::all();
    }

    public function getCountriesProperty()
    {
        return Country::get();
    }

    public function updatedRows()
    {
        $this->resetPage();
    }

    public function UploadFile()
    {
        $this->validate([
            'file' => 'required|mimes:xlx,xlsx',
        ]);
        Excel::import(new OrdersExcelReportImport, $this->file);
        $this->emit('withdrawalsUpdated');

    }

    public function ExcelReport() {
        $orders = Order::when($this->search , function($query){
            $query->where('number' , 'LIKE' , '%'.$this->search.'%' );
        })
        ->when($this->shipping_status != 'all' , function($query){
            $query->where('shipping_statues_id' , $this->shipping_status );
        })
        ->when($this->start_date , function($query){
            $query->whereDate('created_at' , '>=' , $this->start_date );
        })
        ->when($this->end_date , function($query){
            $query->whereDate('created_at' , '<=' , $this->end_date );
        })->get();    

        return Excel::download(new OrdersExcelReportExport($orders), 'orders.xlsx');
    }

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $shipping_statues = ShippingStatus::all();
        $orders = Order::with('country')
        ->when($this->search , function($query){
            $query->where('number' , 'LIKE' , '%'.$this->search.'%' )
            ->orWhere('phone' ,  'LIKE' , '%'.$this->search.'%'  )
            ->orWhere('whats_up' ,  'LIKE' , '%'.$this->search.'%'  )
            ->orWhere('first_name' ,  'LIKE' , '%'.$this->search.'%'  )
            ->orWhere('last_name' ,  'LIKE' , '%'.$this->search.'%'  );
        })
        ->when($this->shipping_status != 'all' , function($query){
            $query->where('shipping_statues_id' , $this->shipping_status );
        })
        ->when($this->start_date , function($query){
            $query->whereDate('created_at' , '>=' , $this->start_date );
        })
        ->when($this->end_date , function($query){
            $query->whereDate('created_at' , '<=' , $this->end_date );
        })
        ->when($this->country_id , function($query){
            $query->where('country_id' ,$this->country_id );
        })
        ->when($this->governorate_id , function($query){
            $query->where('governorate_id' ,$this->governorate_id );
        })
        ->latest()
        ->paginate($this->rows);


        return view('livewire.dashboard.orders.list-all-orders' , compact('orders' , 'shipping_statues'));
    }
}
