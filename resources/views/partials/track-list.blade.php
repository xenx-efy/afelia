@extends('layouts.app')

@push('any-styles')
    <link href={{ asset('/css/tracks.css') }} rel="stylesheet">
@endpush

@section('content')
    <section class="content">
        <div class="container">
            <h2 class="section-title">Календарь учета произведений</h2>
            <form class="search" id="search">
                <label>
                    <input type="text" name="search_s">
                    <span class="placeholder">Введите название</span>
                </label>
                <div class="search-reset">&times;</div>
                <button>Поиск</button>
            </form>
            <div class="content-table">
                <div class="content-table_head">
                    <div class="content-table_head-cell content-table_head-cell-title filter-btn" data-filter="title">Название произведения<div class="icon filter-order" data-value="asc"><img src={{ asset('/image/sort.svg') }} /></div>
                    </div>
                    <div class="content-table_head-cell content-table_head-cell-tags">Теги</div>
                    <div class="content-table_head-cell content-table_head-cell-updated_at filter-btn" data-filter="date">Дата исполнения <div class="icon filter-order" data-value="asc"><img src={{ asset('/image/sort.svg') }} /></div>
                    </div>
                </div>
                <div class="content-table_row">
                    <div class="content-table_row-cell content-table_row-cell-title">Название произведения1</div>
                    <div class="content-table_row-cell content-table_row-cell-tags">
                        <ul>
                            <li>Тег 1</li>
                            <li>Тег 2</li>
                            <li>Тег 3</li>
                            <li>Тег 4</li>
                            <li>Тег 5</li>
                        </ul>
                    </div>
                    <div class="content-table_row-cell content-table_row-cell-date">22 сентября 2019</div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('any-scripts')
    {{-- <script src="{{ asset('/js/app.js') }} "></script> --}}
@endpush
