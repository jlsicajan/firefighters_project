@extends('layouts.app')
@section('after-styles')
    <style>
        .btn-bs-file{
            position:relative;
        }
        .btn-bs-file input[type="file"]{
            position: absolute;
            top: -9999999;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            cursor: inherit;
        }
    </style>
    <link href="/fileinput/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Vista general del proyecto</div>

                    <div class="panel-body text-center">
                        Desarollador: <strong>Jose Luis Sicajan Coy</strong>
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone else.
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1"
                                       placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Example select</label>
                                <select class="form-control" id="exampleSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect2">Example multiple select</label>
                                <select multiple class="form-control" id="exampleSelect2">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Example textarea</label>
                                <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <input type="file" class="form-control-file" id="exampleInputFile"
                                       aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level
                                    help text for the above input. It's a bit lighter and easily wraps to a new line.
                                </small>
                            </div>
                            <fieldset class="form-group">
                                <legend>Radio buttons</legend>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optionsRadios"
                                               id="optionsRadios1" value="option1" checked>
                                        Option one is this and that&mdash;be sure to include why it's great
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optionsRadios"
                                               id="optionsRadios2" value="option2">
                                        Option two can be something else and selecting it will deselect option one
                                    </label>
                                </div>
                                <div class="form-check disabled">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optionsRadios"
                                               id="optionsRadios3" value="option3" disabled>
                                        Option three is disabled
                                    </label>
                                </div>
                                <div class="form-group text-center">
                                    <label class="btn-bs-file btn btn-lg btn-success">SUBIR <input type="file" name="file_gas_spend" id="file_gas_spend"/>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input id="img_gas_spend" name="img_gas_spend" class="file" type="file">
                                </div>
                            </fieldset>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">
                                    Check me out
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script src="/fileinput/fileinput.js" type="text/javascript"></script>
    <script src="/fileinput/locales/es.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("#img_gas_spend").fileinput({
            dropZoneEnabled: false,
            overwriteInitial: false,
            maxFileSize: 20000,
            maxFilesNum: 1,
            showUpload: false,
            showCaption: false,
            fileType: "any",
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            initialPreviewAsData: true,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
    </script>
@endsection