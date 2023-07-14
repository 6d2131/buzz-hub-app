<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzz Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="bg-dark vh-100">
    <div class="container h-100 px-4" style="max-width:600px;">
        <div class="row" style="height: 13%">
            <div class="col">
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-6 text-center">
                        <a href="/timeline" class="fs-1 mb-0" style="text-decoration: none;">Buzz Hub</a>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-top: 14px; width: 50px;">
                        投稿
                        </button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                    </div>
                    <div class="col">
                        <form action="/timeline" method="get">
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" name="content" style="height: 31px;"/>
                                <button type="submit" class="btn btn-primary btn-sm" style="min-width: 50px;">
                                検索
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">投稿フォーム</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/post" method="post">
                        @csrf
                        <div class="modal-body">
                            <textarea class="form-control" name="content" rows="4" cols="40"> </textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">投稿する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach($posts as $post)
        <div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">編集フォーム</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/post/{{ $post->id }}" method="post">
                        <input type="hidden" name="_method" value="PUT"/>
                        @csrf
                        <div class="modal-body">
                            <textarea class="form-control" name="content" rows="4" cols="40">{{$post->content}}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">更新する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row overflow-y-auto" style="height: 87%;">
            <div class="col">
                @foreach($posts as $post)
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="card-title">{{ $post->user_name }}</span>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <span class="card-subtitle mb-2 text-muted">{{ $post->created_at }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <p class="card-text">{{ $post->content }}</p>
                            </div>
                            @if($post->user_id == $id)
                            <div class="col-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $post->id }}" style="width: 46px; height: 29px;">
                                編集
                                </button>
                                <form action="/post/{{ $post->id }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    <button type="submit" class="btn btn-danger btn-sm" style="width: 46px; height: 29px;">
                                    削除
                                    </button>
                                </from>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(function() {
        var API_KEY = 'd0691dd85a9130f26b631da51d0ec9bd';
        var city = 'Tokyo';
        var url = 'http://api.openweathermap.org/data/2.5/weather?q=' + city + ',jp&units=metric&APPID=' + API_KEY;
        $.ajax({
            url: url,
            dataType: "json",
            type: 'GET',
        })
        .done(function(data) {
            const weatherId = data.weather[0].id;
            // const weatherId = 200
            if (weatherId >= 200 && weatherId <= 232) {
                $('.container').css('background-image', 'url(/image/thunder.png)')
            } else if (weatherId >= 300 && weatherId <= 531) {
                $('.container').css('background-image', 'url(/image/rain.png)')
            } else if (weatherId >= 600 && weatherId <= 622) {
                $('.container').css('background-image', 'url(/image/snow.png)')
            } else if (weatherId == 800) {
                $('.container').css('background-image', 'url(/image/sunny.png)')
            } else if (weatherId >= 801 && weatherId <= 804) {
                $('.container').css('background-image', 'url(/image/cloud.png)')
            } else {

            }
            // console.log(data);
        })
        .fail(function(data) {
        });
        });

        </script>
</body>
</html>