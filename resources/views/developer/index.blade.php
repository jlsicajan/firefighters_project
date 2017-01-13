@extends('layouts.app')
@section('after-styles')
    <style>
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width: 70%;
            margin: auto;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading text-center">Vista general del proyecto</div>

            <div class="panel-body text-center">
                Desarollador: <strong>Jose Luis Sicajan Coy</strong>
                <div id="carousel_developer" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel_developer" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel_developer" data-slide-to="1"></li>
                        <li data-target="#carousel_developer" data-slide-to="2"></li>
                        <li data-target="#carousel_developer" data-slide-to="3"></li>
                        <li data-target="#carousel_developer" data-slide-to="4"></li>
                        <li data-target="#carousel_developer" data-slide-to="5"></li>
                        <li data-target="#carousel_developer" data-slide-to="6"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="{{ url('/images/developer/combustible_view.png') }}" width="460" height="345">
                        </div>

                        <div class="item">
                            <img src="{{ url('/images/developer/general_view.png') }}" width="460" height="345">
                        </div>

                        <div class="item">
                            <img src="{{ url('/images/developer/rd_view.png') }}" width="460" height="345">
                        </div>

                        <div class="item">
                            <img src="{{ url('/images/developer/tdp22_view.png') }}" width="460" height="345">
                        </div>

                        <div class="item">
                            <img src="{{ url('/images/developer/ad21_view.png') }}" width="460" height="345">
                        </div>

                        <div class="item">
                            <img src="{{ url('/images/developer/general_view_two.png') }}" width="460" height="345">
                        </div>

                        <div class="item">
                            <img src="{{ url('/images/developer/pdf_report.png') }}" width="460" height="345">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#carousel_developer" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="right carousel-control" href="#carousel_developer" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Siguienre</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
