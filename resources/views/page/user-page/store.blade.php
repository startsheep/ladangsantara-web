@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
@endphp

@extends('page.app')
@section('content')
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('web.home.index') }}">Beranda</a></li>
                <li>Toko</li>
                <li>{{ $store->name }}</li>
            </ol>
            <h2>{{ $store->name }}</h2>

        </div>
    </section>

    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <img src="{{ $store->logo }}" alt="{{ $store->name }}" width="100%">
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>Informasi Toko</h3>
                        <ul>
                            <li><strong>Nama Toko</strong>: {{ $store->name }}</li>
                            <li><strong>Alamat</strong>: {{ $store->address }}</li>
                            <li><strong>Terdaftar Pada</strong>:
                                {{ Carbon::createFromFormat('Y-m-d H:i:s', $store->created_at)->isoFormat('DD MMMM Y') }}
                            </li>
                        </ul>
                    </div>
                    <div class="portfolio-description">
                        <h2>Deskripsi Toko</h2>
                        <p>
                            {{ $store->description }}
                        </p>
                    </div>
                </div>

            </div>

            <div class="mt-4">
                <h3>Produk Toko</h3>
                <div class="row mt-3">
                    @foreach ($store->products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                            <a href="" id="showDetail" data-bs-toggle="modal" data-bs-target="#detailProductModal"
                                data-name="{{ $product->name }}" data-image="{{ $product->image }}"
                                data-category="{{ $product->category }}"
                                data-price="Rp {{ number_format($product->price, 0, ',', '.') }}"
                                data-stock="{{ $product->stock }}" data-description="{{ $product->description }}">
                                <div class="card">
                                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}"
                                        height="200">
                                    <div class="card-body">
                                        <p class="small badge bg-primary text-uppercase">{{ $product->category }}</p>
                                        <h5 class="card-title fw-bold fs-5">{{ $product->name }}</h5>
                                        <p class="card-text mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}
                                        <p class="card-text">Sisa {{ $product->stock }} stok</p>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="detailProductModal" tabindex="-1" aria-labelledby="detailProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailProductModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-lg-4 mb-3">
                            <center>
                                <img src="" alt="" id="detailProductImage" height="250" width="250">
                            </center>
                        </div>
                        <div class="col-lg-8">
                            <h5 class="mb-3 text-center">Informasi Produk</h5>
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th class="border p-2" style="background-color: #cfe2ff">Nama Produk</th>
                                    <td class="border p-2" id="detailProductName"></td>
                                </tr>
                                <tr>
                                    <th class="border p-2" style="background-color: #cfe2ff">Kategori Produk</th>
                                    <td class="border p-2" id="detailProductCategory"></td>
                                </tr>
                                <tr>
                                    <th class="border p-2" style="background-color: #cfe2ff">Harga Produk</th>
                                    <td class="border p-2" id="detailProductPrice"></td>
                                </tr>
                                <tr>
                                    <th class="border p-2" style="background-color: #cfe2ff">Stok Produk</th>
                                    <td class="border p-2" id="detailProductStock"></td>
                                </tr>
                                <tr>
                                    <th class="border p-2" style="background-color: #cfe2ff">Deskripsi Produk</th>
                                    <td class="border p-2" id="detailProductDescription"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $("body").on("click", "#showDetail", function() {
                $("#detailProductModalLabel").html($(this).data('name'))
                $("#detailProductImage").attr('src', $(this).data('image')).attr('alt', $(this).data(
                    'name'))
                $("#detailProductName").html($(this).data('name'))
                $("#detailProductPrice").html($(this).data('price'))
                $("#detailProductStock").html($(this).data('stock'))
                $("#detailProductCategory").html($(this).data('category'))
                $("#detailProductDescription").html($(this).data('description'))
            });
        })
    </script>
@endsection
