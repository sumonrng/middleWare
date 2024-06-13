<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
          </nav>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th scope="col">Action</th>
                      </tr>
                </thead>
                <tbody>
                    @foreach ($user as $row)
                  <tr>
                    <th>{{$row->id}}</th>
                    <td>{{$row->title}}</td>
                    <td>{{$row->price}}</td>
                    <td scope="row">
                        @canany(['update', 'view', 'delete'], $row)
                            <a href="{{ route('books.show', $row->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('books.edit',$row->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{route('books.destroy',$row->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        @else
                            <h6>Not Authorize</h6>
                        @endcanany
                       
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
    </div>
    
</body>
</html>