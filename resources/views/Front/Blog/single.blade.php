@extends('Front.layouts.master')
@section('title','Makale')
@section('content')
<style>

    .singleArticle {
        background: #ECECEC;
    }

    .article {
        margin-top: 50px;
    }

    .title h1 {
        margin: 0;
        padding: 10px 0;
        border-bottom: 2px solid #00ADB5;
    }

    .articleContent {
        padding: 20px 0;
    }

    .articleContent h4 {
        line-height: 27px;
    }

    .container.singleArticle {
        background: #f5f5f5 !important;
    }

    .conciseSentence {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100px;
        margin-top: 50px;
        border: 1px solid #00ADB5;
        border-radius: 5px;
        -webkit-box-shadow: 0px 11px 40px -21px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 11px 40px -21px rgba(0,0,0,0.75);
        box-shadow: 0px 11px 40px -21px rgba(0,0,0,0.75);
    }

    .conciseSentence h3 {
        margin-bottom: 3px;
    }

    h1, h2, h3, h4, h5 {
        margin: 0;
    }


    .joinDiscussion {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin: 50px 0;
    }

    .joinDiscussion h4 {
        line-height: 27px;
        width: 70%;
        margin-bottom: 10px;
    }

    .joinDiscussion a {
        border: none;
        background: #00ADB5;
        color: #fff;
        padding: 10px 20px;
        border-radius: 100px;
    }

    .joinDiscussion a:hover {
        color: #fff !important;
        background: #00b5be;
    }

    .fastAccesBar {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 50px;
    }

    ol, ul {
        list-style: none;
    }

    .fastAccesBar .categories {
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: end;
    }

    .fastAccesBar .categories .categoryList {
        width: 100%;
    }

    .fastAccesBar .categories .categoryList ul {
        margin: 0;
    }

    .fastAccesBar .categories .categoryList ul li a:hover {
        text-decoration: underline !important;
    }

    .fastAccesBar .categories .categoryTitle {
        border-bottom: 2px solid #00ADB5;
        width: 100%;
        padding: 12px 0;
    }

    .wordSearch {
        display: flex;
        width: 50%;
        border-radius: 13px;
        border: 1px solid rgb(108, 117, 125);
    }

    .wordSearchBar {
        flex: 1;
    }

    .wordSearch input {
        border: none;
        border-radius: 13px;
        padding: 0 5px;
        width: 100%;
        background: transparent;
    }

    .wordSearch input::placeholder {
        color: rgb(108, 117, 125);
    }

    .wordSearch input:focus {
        outline: 0;
    }

    .searchIcon {
        display: flex;
        align-items: center;
        margin: 0 5px 0 0;
    }

    .populars {
        width: 50%;
        text-align: right;
    }

    .popularsTitle {
        border-bottom: 2px solid #00ADB5;
        width: 100%;
        padding: 12px 0;
    }

    .popularsList ul {
        margin: 0;
        padding: 0;
    }

    .popularsList ul li {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        color: #00ADB5;
    }

    .popularsList ul li a {
        font-size: 16px;
    }

    .popularsList ul li a:hover {
        text-decoration: underline !important;
    }

</style>

<div class="singleArticle">
    <div class="container singleArticle">
        <div class="col-md-6 article">
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
        <div class="col-md-6 fastAccesBar">

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

            <div class="font-sizeSelector">
                <input type="radio" onChange="changeFont" name="asd" id="F12px">
                <input type="radio" name="asd" id="F14px">
                <input type="radio" name="asd" id="F16px">
                <input type="radio" name="asd" id="">
                <input type="radio" name="asd" id="">
                <input type="radio" name="asd" id="">
                <input type="radio" name="asd" id="">
            </div>

        </div>

    </div>
</div>


<script>
    let changeFont = () => {
    }
</script>
@endsection
