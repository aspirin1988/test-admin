@extends('layouts.app')

@section('content')
    <div class="uk-grid" ng-controller="EditNews" ng-init="NewsID={{$id}}">
        <div class="uk-width-1-1">
            <div class="uk-panel uk-panel-box">
                <h3 class="uk-panel-title">Редактирование новости</h3>
                <div class="uk-panel-body uk-form uk-form-horizontal">
                    <fieldset data-uk-margin>
                        <legend></legend>

                        <div class="uk-form-row">
                            <label for="edit_by" class="uk-form-label">Ответственный:</label>
                            <div class="uk-form-controls">
                                <input type="text" id="edit_by" ng-model="NewsData.edit_by" class="uk-width-1-1"
                                       placeholder="Ответственный">
                            </div>
                        </div>

                        <div class="uk-form-row">
                            <label for="autor" class="uk-form-label">Авторы публикации:</label>
                            <div class="uk-form-controls">
                                <input type="text" id="autor" ng-model="NewsData.autor" class="uk-width-1-2"
                                       placeholder="Авторы публикации">
                            </div>
                        </div>
                        <div class="uk-container">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-1-3" ng-repeat="(key,val) in NewsData.Authors">
                                    <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                                        [[val.UserData.name]]
                                        <a href="" class="uk-float-right uk-close uk-close-alt"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
@endsection
