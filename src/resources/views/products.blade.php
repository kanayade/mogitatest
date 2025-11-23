@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="sidebar">
        <div class="sidebar-title">
            <h2>商品一覧</h2>
        </div>
        <form action="/products" method="get" enctype="multipart/form-data">
            <input class="search_enter" type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}"><br>
            <button class="search-btn">検索</button><br>
            <label>価格順で表示</label>
            <select class="search-select" name="select" placeholder="価格で並び替え">
                <option>価格で並び替え</option>
                <option value="asc" {{ request('select') === 'asc' ? 'selected' : '' }}>安い順</option>
                <option value="desc" {{request('select') === 'desc' ? 'selected' : '' }}>高い順</option>
            </select>
        </form>
    </div>
    <div class="add-button">
        <a href="/register" class="add-button">+ 商品を追加</a>
    </div>
    <div class="products-area">
    @foreach ($products as $product)
        <div class="fruits-products">
            <a href="{{ url('/products/' . $product->id) }}">
            <img src="{{ asset('storage/product/' . $product->image) }}" alt="{{ $product->name }}">
            </a>
            <h2>{{ $product->name }}</h2>
            <p>¥{{ number_format($product->price) }}</p>
        </div>
    @endforeach
    </div>
    <div class="pagenation">
        @if ($products->currentPage() > 1)
        <a href="{{ $products->previousPageUrl() }}">←</a>
        @else
        <span>←</span>
        @endif

        @for ($i = 1; $i <= $products->lastPage(); $i++)
        @if ($i == $products->currentPage())
        <strong>{{ $i }}</strong>
        @else
        <a href="{{ $products->url($i) }}">{{ $i }}</a>
        @endif
        @endfor

        @if ($products->currentPage() < $products->lastPage())
        <a href="{{ $products->nextPageUrl() }}">→</a>
        @else
        <span>→</span>
        @endif
    </div>
</div>
@endsection