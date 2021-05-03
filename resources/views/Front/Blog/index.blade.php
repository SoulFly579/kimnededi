@extends('Front.layouts.master')
@section('title','Blog')
@section('content')
<div id="blogs">
    <div class="container blogs">
        <div class="row articles_categories">
            @include("Front.widgetsler.articlesWidgets")

            @include("Front.widgetsler.categoryWidgets")


                <div class="font-sizeSelectorTitle">
                    <h2>Yazı Büyüklüğü</h2>
                </div>

                <div class="font-sizeSelector">
                    <div class="font-size">
                        <p>12</p>    
                        <input type="radio" onChange="changeFont12()" name="fontChanger" id="F12px">
                    </div>
                    <div class="font-size">
                        <p>14</p>    
                        <input type="radio" onChange="changeFont" name="fontChanger" id="F14px">
                    </div>
                    <div class="font-size">
                        <p>16</p>    
                        <input type="radio" onChange="changeFont" name="fontChanger" id="F16px">
                    </div>
                    <div class="font-size">
                        <p>18</p>    
                        <input type="radio" onChange="changeFont" name="fontChanger" id="F18px">
                    </div>
                    <div class="font-size">
                        <p>20</p>    
                        <input type="radio" onChange="changeFont" name="fontChanger" id="F20px">
                    </div>
                    <div class="font-size">
                        <p>22</p>    
                        <input type="radio" onChange="changeFont" name="fontChanger" id="F22px">
                    </div>
                    <div class="font-size">
                        <p>24</p>    
                        <input type="radio" onChange="changeFont" name="fontChanger" id="F24px">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        let articlesContent = $(.oneArticle)
        let changeFont12 => () {
            articlesContent.style.fontSize = "12px";
        }
    </script>
@endsection
