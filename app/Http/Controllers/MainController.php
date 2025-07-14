<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function detailProduk(Request $request, $slug)
    {
        return view("member.produk.detail", compact('slug'));
    }
    public function detailProdukReferral(Request $request,  $slug)
    {
        return view("referral.detailProduk", compact('slug'));
    }

    public function detailProdukGerai(Request $request, $slug)
    {
        return view("member.gerai.detailProduk", compact('slug'));
    }

    public function selesaiPesanan($slug)
    {
        return view("member.produk.selesai_pesanan", compact('slug'));
    }

    public function invoice($no_invoice)
    {
        return view('member.produk.invoice', compact('no_invoice'));
    }

    public function redirectMap(Request $request)
    {
        $lat = $request->lat;
        $long = $request->long;
        return redirect("https://maps.google.com?q=$lat,$long");
    }

    public function katalogProduk($gudang_id)
    {
         // Get the full API URL
        $apiUrl = config('api.url');

        $client = new Client();
        $response = $client->get($apiUrl . '/v1/toko-penyimpanan-public?harga=retail&gudang_id=' . $gudang_id . '&show_as_product=1', [
            'headers' => [
                'secret' => 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                'device' => 'web'
            ]
        ]);
        $data = json_decode($response->getBody()->getContents(), true);
        return view('member.produk.pdf.katalog', ['data' => $data['data']]);
        // Process the $data as needed
    }

    public function preOrder()
    {
        return view('member.produk.preOrder.index');
    }
    public function preOrderUbah()
    {
        return view('member.produk.preOrder.edit');
    }

    public function preOrderMemberCard()
    {
        return view('member.produk.preOrder.memberCard');
    }
}
