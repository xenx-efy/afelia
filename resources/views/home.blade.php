@extends('layouts.app')

@section('title', 'Список')

@push('any-styles')
    <link href={{ asset('/css/tracks.css') }} rel="stylesheet">
@endpush

@section('content')
    <header>
        <div class="container">
            <h2 class="section-title">Календарь учета произведений</h2>
            <form class="search" name="search" id="search">
                <input type="hidden" name="filterTitle" value="asc">
                <input type="hidden" name="filterTags" value="">
                <input type="hidden" name="filterDate" value="asc">
                <label>
                    <input type="text" name="searchString">
                    <span class="placeholder">Введите название</span>
                </label>
                <button name="btnReset" type="reset" class="search-reset">&times;</button>
                <button name="btnSubmit" type="submit">Поиск</button>
            </form>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="table">
                <div class="table-head">
                    <div class="table-head_cell table-head_cell-title filter-btn" data-filter="title">
                        Название произведения
                        <div class="icon filter-order" data-value="asc">
                            <img src={{ asset('/image/sort.svg') }} />
                        </div>
                    </div>
                    <div class="table-head_cell table-head_cell-tags">Теги</div>
                    <div class="table-head_cell table-head_cell-updated_at filter-btn" data-filter="date">Дата исполнения <div class="icon filter-order" data-value="asc"><img src={{ asset('/image/sort.svg') }} /></div>
                    </div>
                </div>
                <div class="table-body">
                    <div class="table-row">
                        <div class="table-row_cell table-row_cell-title">Название произведения1</div>
                        <div class="table-row_cell table-row_cell-tags">
                            <ul>
                                <li>Тег 1</li>
                                <li>Тег 2</li>
                                <li>Тег 3</li>
                                <li>Тег 4</li>
                                <li>Тег 5</li>
                            </ul>
                        </div>
                        <div class="table-row_cell table-row_cell-date">22 сентября 2019</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('any-scripts')
    <script src="{{ asset('/js/track.js') }} "></script>
@endpush
