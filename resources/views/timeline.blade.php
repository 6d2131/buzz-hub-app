<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"></head>
<body>
    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <form action="/timeline" method="get">
                    <input type="text" class="form-control" name="content"/>
                    <button type="submit" class="btn btn-primary">
                    検索
                    </button>
                </form>
            </div>
            <div class="col">
                <h1 class="text-center">Buzz Hub</h1>
            </div>
            <div class="col d-flex justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                投稿
                </button>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/post" method="post">
                        @csrf
                        <div class="modal-body">
                            <textarea name="content" rows="4" cols="40"> </textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach($posts as $post)
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-title">{{ $post->user_name }}</span>
                        <!-- <span class="card-subtitle mb-2 text-muted">@yamada</span> -->
                    </div>
                    <div class="col d-flex justify-content-end">
                        <span class="card-subtitle mb-2 text-muted">{{ $post->created_at }}</span>
                    </div>
                </div>
                <p class="card-text">{{ $post->content }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>