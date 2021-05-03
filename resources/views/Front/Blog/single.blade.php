@extends('Front.layouts.master')
@section('title','Makale')
@section('content')

<div class="singleArticle">
    <div class="container singleArticle">
        <div class="col-md-7 article">
            <div class="title">
                <h1>{{$article->title}}</h1>
            </div>
            <div class="articleContent">
                <h4>{!! $article->content !!}</h4>
            </div>
            <div class="author">
                <h3>-{{$article->getAuthor->name}} {{$article->getAuthor->surname}}</h3>
            </div>
            <div class="joinDiscussion">
                <h4>Hadi sende diğer kullanıcıların fikirlerini görmek için ve kendi fikrini belirtmek için Tıkla!!</h4>
                <a href="discussion.php">Tartışmaya Katıl</a>
            </div>
        </div>
        <div class="col-md-5 fastAccesBar">

            <div class="wordSearch">
                <div class="wordSearchBar">
                    <input type="text" class="wordSearchInput" placeholder="söz arayın">
                </div>
                <a href="search/" class="searchIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </a>
            </div>

            <div class="categories">
                <div class="categoryTitle">
                    <h2>Kategoriler</h2>
                </div>
                <div class="categoryList">
                    <ul>
                        <li>
                            <a href="#">Bilim</a>
                        </li>
                        <li>
                            <a href="#">Siyaset</a>
                        </li>
                        <li>
                            <a href="#">Teknoloji</a>
                        </li>
                        <li>
                            <a href="#">Sanat</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="populars">
                <div class="popularsTitle">
                    <h2>En Çok Okunanlar</h2>
                </div>
                <div class="popularsList">
                    <ul>
                        <li>
                            <a href="#">1 Ayda Kaç Kilo Verdim!</a>
                        </li>
                        <li>
                            <a href="#">4 Yılda Nasıl Zengin Oldum?</a>
                        </li>
                        <li>
                            <a href="#">Karşınızdakini Anlamak</a>
                        </li>
                        <li>
                            <a href="#">Tutkunuzu Bulmak</a>
                        </li>
                        <li>
                            <a href="#">Enespınarenespınarenespınarenespınarenespınarenespınar</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
