@extends('Front.layouts.master')
@section('title','Blog')
@section('content')
<div id="blogs">
    <div class="container blogs">
        <div class="row">
            <style>
                body{
                    background: #ECECEC;
                }
                .blogs {
                    background: #f5f5f5 !important;
                    padding-top: 50px;
                }

                .col-md-8 {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }

                .articlesTitle {
                    border-bottom: 1px solid #00ADB5;
                    padding: 12px 0;
                }

                .oneArticle {
                    text-align: center;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    border-bottom: 1px solid #333;
                    padding: 40px 20px;
                }

                .oneArticle h3 {
                    border-bottom: 1px solid #00ADB5;
                    padding: 10px;
                    width: 60%;
                }

                .oneArticle p {
                    text-align: left;
                    margin: 20px 0 0 0 !important;
                }

                .articleFooter {
                    display: flex;
                    justify-content: space-between;
                    width: 100%;
                }

                .artcileDesc {
                    display: flex;
                }

                .artcileDesc span {
                    display: flex;
                    margin-right: 10px;
                    align-items: center;
                    justify-content: center;
                }

                .artcileDesc span svg {
                    margin-right: 10%;
                }

                .articleAuthor {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    white-space: nowrap;
                }

                .articleAuthor svg {
                    margin-left: 10px;
                }

                .btn {
                    background: #00ADB5;
                    color: #ECECEC;
                    margin: 15px 0;
                }

                .fastAccesBar {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }

                ol, ul {
                    list-style: none;
                }
                h1, h2, h3, h4, h5 {
                    margin: 0;
                }

                .fastAccesBar .categories {
                    width: 50%;
                    display: flex;
                    flex-direction: column;
                    text-align: end;
                }

                .fastAccesBar .categories .categoryList {
                    width: 100%;
                }

                .fastAccesBar .categories .categoryTitle {
                    border-bottom: 1px solid #00ADB5;
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


                @media only screen and (max-width: 365px) {
                    .oneArticle {
                        padding: 20px 0;
                    }
                    .artcileDesc span svg {
                        margin: 0;
                    }
                    .articleAuthor svg {
                        margin: 0;
                    }
                }

            </style>
            @include("Front.widgetsler.articlesWidgets")

            @include("Front.widgetsler.categoryWidgets")

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
        let changeFont => ()
    </script>
@endsection
