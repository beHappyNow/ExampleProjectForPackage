@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <p> Это главная страничка сайта демонстрирующего работу пакета созданного в рамках тестового задания на вакансию Middle php dev(Laravel)</p>
            </div>
            <div class="col-md-offset-2 col-md-8">
                <p>Данное тестовое задание выполнил Белоножко Артём.</p>
                <br/>
                <p>Для использования пакета необходимо выполнить следующие действия:</p>
                <ul>
                    <li><p>Загрузить пакет с помощью composer'а.</p>
                        <p>К примеру можно прописать в composer.json</p>
                        <p>"require": {</p>
                        <p>   "amgradetz/geocoding": "dev-master"</p>
                        <p>}, и сделать апдейт</p>
                    </li>
                    <li>
                        <p>Прописать в "config/app.php", в разделе providers - AMgradeTZ\GeoCoding\GeoCodingServiceProvider::class,</p>
                        <p>а в разделе aliases - 'geocoder'=> AMgradeTZ\GeoCoding\GeoCodingFacade::class,</p>
                    </li>
                    <li>
                        выполить в консоли команду php artisan vendor:publish , что бы добавить настройки пакета.
                    </li>
                </ul>
                <br/>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="/test">Страничка демонстрирующая работу "прямого" геокодирования</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="/test1">Страничка демонстрирующая работу "обратного" геокодирования</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection