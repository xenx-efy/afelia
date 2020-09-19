@extends('layouts.app')

@section('title', 'Список')

@push('any-styles')
    <link href={{ asset('/css/tracks.css') }} rel="stylesheet">
@endpush

@section('content')
    <header>
        <div class="container">
            <h2 class="section-title">Календарь учета произведений</h2>
            <form class="search" name="searchForm" id="search">
                <button class="tag-btn"><img src="./image/tag.svg"></button>
                <label>
                    <input type="text" name="searchString" autocomplete="false">
                    <span class="placeholder">Введите название</span>
                </label>
                <button name="btnReset" type="reset" class="search-reset"><img src="{{ asset('/image/close.svg') }}"></button>
                <button name="btnSubmit" type="submit" autofocus>Поиск</button>
            </form>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="table">
                <div class="table-head">
                    <div class="table-head_cell table-head_cell-title" data-filter="title">
                        <button class="fake-btn sortBy sortByTitle disagree" data-sort-By="title" data-sort-Type-Default="asc">Название произведения</button>
                        <button class="icon sortType" data-for=".sortByTitle">
                            <img src={{ asset('/image/sort.svg') }} />
                        </button>
                    </div>
                    <div class="table-head_cell table-head_cell-tags">Теги</div>
                    <div class="table-head_cell table-head_cell-updated_at filter-btn" data-filter="date">
                        <button class="fake-btn sortBy sortByDate disagree" data-sort-By="last_played" data-sort-Type-Default="desc">Дата исполнения</button>
                        <button class="icon sortType" data-for=".sortByDate"><img src={{ asset('/image/sort.svg') }} /></button>
                    </div>
                </div>
                <div class="table-body">
                    @foreach($tracks as $track)
                        <div class="table-row">
                            <input type="hidden" name="tracks[]" value="{{ $track->id }}">
                            <div class="table-row_cell table-row_cell-title"><div class="author">{{ $track->composer->composer_name }}</div>{{ $track->title }}</div>
                            <div class="table-row_cell table-row_cell-tags">
                                <ul class="tags-list">
                                    @foreach($track->tags as $tag)
                                        <li class="tags-list_item">{{ $tag->title }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="table-row_cell table-row_cell-date">{{ $track->last_played }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="errors-list"></div>
    </main>
    <div class="all-tags hidden">
        <ul class="tags-list">
           @foreach($tags as $tag)
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="hidden">
                        <li class="tags-list_item">
                            {{ $tag->title }}
                        </li>
                    </label>
            @endforeach
        </ul>
    </div>
@endsection

@push('any-scripts')
    <script src="{{ asset('/js/track.js') }} "></script>
@endpush
