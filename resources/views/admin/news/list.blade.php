@extends('layouts.app')

@section('content')
    <div class="uk-grid" ng-controller="NewsPage">
        <div class="uk-width-1-1">
            <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title">Список новостей

                </h3>
                <ul class="uk-pagination">
                    <li ng-class="{'uk-disabled':CurrentPage===0}">
                        <span ng-if="CurrentPage===0"><i class="uk-icon-angle-double-left"></i></span>
                        <a ng-if="CurrentPage>0" ng-click="getPageNews(0)"><i class="uk-icon-angle-double-left"></i></a>
                    </li>
                    <li ng-class="{'uk-disabled':CurrentPage===0}">
                        <span ng-if="CurrentPage===0"><i class="uk-icon-angle-left"></i></span>
                        <a ng-if="CurrentPage>0" ng-click="getPageNews(CurrentPage-1)"><i
                                    class="uk-icon-angle-left"></i></a>
                    </li>
                    <li ng-repeat="(key,val) in NewsPageCountList" ng-class="{'uk-active':val==CurrentPage}">
                        <span ng-if="val===CurrentPage">[[val+1]]</span>
                        <a ng-if="val!==CurrentPage" ng-click="getPageNews(val)">[[val+1]]</a>
                    </li>
                    <li ng-class="{'uk-disabled':CurrentPage===NewsPageCount}">
                        <span ng-if="CurrentPage===NewsPageCount"><i class="uk-icon-angle-right"></i></span>
                        <a ng-if="CurrentPage < NewsPageCount" ng-click="getPageNews(CurrentPage+1)"><i
                                    class="uk-icon-angle-right"></i></a>
                    </li>
                    <li ng-class="{'uk-disabled':CurrentPage===NewsPageCount}">
                        <span ng-if="CurrentPage===NewsPageCount"><i class="uk-icon-angle-double-right"></i></span>
                        <a ng-if="CurrentPage < NewsPageCount" ng-click="getPageNews(NewsPageCount-1)"><i
                                    class="uk-icon-angle-double-right"></i></a>
                    </li>
                </ul>

                <div class="uk-panel-body">

                    <article class="uk-comment" ng-repeat="(key,val) in News_list">
                        Статус : <span class="uk-badge "
                                       ng-class="{
                              'uk-badge-success':val.status=='published',
                              'uk-badge-danger':val.status=='new',
                              'uk-badge-warning':val.status=='editing'}">

                            [[(val.status=='new'?'Повод':'')]]
                            [[(val.status=='editing'?'Подготавливается':'')]]
                            [[(val.status=='ready'?'Готово к выпуску':'')]]
                            [[(val.status=='unpublished'?'Не опубликована':'')]]
                            [[(val.status=='published'?'Опубликовано':'')]]
                            [[(val.status=='deleted'?'Снята с публикации':'')]]
                        </span>
                        <header class="uk-comment-header">
                            <img class="uk-comment-avatar"
                                 src="https://getuikit.com/v2/docs/images/placeholder_avatar.svg" width="50" height="50"
                                 alt="">

                            <h4 class="uk-comment-title">
                                [[val.header]]
                            </h4>

                            <div class="uk-comment-meta uk-margin-top">
                                <div class="uk-button-group uk-width-1-5">
                                    <a class="uk-button uk-button-success uk-button-mini"
                                       href="/admin/news/edit/[[val.id]]">Edit</a>
                                    <a class="uk-button uk-button-primary uk-button-mini"
                                       href="/admin/news/copy/[[val.id]]">Copy</a>
                                    <a class="uk-button uk-button-danger uk-button-mini"
                                       href="/admin/news/delelte/[[val.id]]">Delete</a>
                                </div>
                                <span ng-if="val.create_date || var.created_at">Создан: [[val.create_date || var.created_at]]</span>
                                <span ng-if="val.publish_date || var.updated_at">| Опубликован: [[val.publish_date || var.updated_at]]</span>
                                <span> | ID : [[val.id]]</span>
                            </div>
                        </header>
                    </article>
                    <ul class="uk-pagination">
                        <li ng-class="{'uk-disabled':CurrentPage===0}">
                            <span ng-if="CurrentPage===0"><i class="uk-icon-angle-double-left"></i></span>
                            <a ng-if="CurrentPage>0" ng-click="getPageNews(0)"><i class="uk-icon-angle-double-left"></i></a>
                        </li>
                        <li ng-class="{'uk-disabled':CurrentPage===0}">
                            <span ng-if="CurrentPage===0"><i class="uk-icon-angle-left"></i></span>
                            <a ng-if="CurrentPage>0" ng-click="getPageNews(CurrentPage-1)"><i
                                        class="uk-icon-angle-left"></i></a>
                        </li>
                        <li ng-repeat="(key,val) in NewsPageCountList" ng-class="{'uk-active':val==CurrentPage}">
                            <span ng-if="val===CurrentPage">[[val+1]]</span>
                            <a ng-if="val!==CurrentPage" ng-click="getPageNews(val)">[[val+1]]</a>
                        </li>
                        <li ng-class="{'uk-disabled':CurrentPage===NewsPageCount}">
                            <span ng-if="CurrentPage===NewsPageCount"><i class="uk-icon-angle-right"></i></span>
                            <a ng-if="CurrentPage < NewsPageCount" ng-click="getPageNews(CurrentPage+1)"><i
                                        class="uk-icon-angle-right"></i></a>
                        </li>
                        <li ng-class="{'uk-disabled':CurrentPage===NewsPageCount}">
                            <span ng-if="CurrentPage===NewsPageCount"><i class="uk-icon-angle-double-right"></i></span>
                            <a ng-if="CurrentPage < NewsPageCount" ng-click="getPageNews(NewsPageCount-1)"><i
                                        class="uk-icon-angle-double-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
