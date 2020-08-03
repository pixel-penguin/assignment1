<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\InvoiceItemProduct;
use App\InvoiceItem;
use App\Invoice;

class InvoiceController extends Controller
{
    public function index(){

        $invoices = Invoice::All();

        return view('invoice.index', ['invoices' => $invoices]);
    }

    public function create(){

        return view('invoice.create');
    }

    public function store(Request $request){
        $input = $request->all();

        //$invoiceItems = $input['invoiceItems'];
        
        $invoice = new Invoice();

        $invoice->sub_amount = $input['subTotal'];
        $invoice->percentage = $input['percentagePrice'];
        $invoice->amount = $input['totalPrice'];

        $invoice->save();

        foreach($input['invoiceItems'] as $item){
            $invoiceItem = new InvoiceItem();

            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->invoice_item_product_id = $item['invoice_item_product_id'];
            $invoiceItem->quantity = $item['quantity'];
            $invoiceItem->price = $item['price'];
            $invoiceItem->save();
        }
        

        return [
            'success' => true
        ];
        //dd($input);
    }

    public function getAllInvoiceItemProducts(){

        $products = InvoiceItemProduct::orderBy('name')->get();
        
        if(!isset($products[0])){
            return [
                'success' => false,
                'message' => 'dammmit man, something went wrong'
            ];    
        }

        return [
            'success' => true,
            'data' => $products
        ];

    }
}
