<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Json Dashboard</title>
</head>
<body>
<h1>Formulaire :</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif


<form action="{{ route('admin.import.students') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="jsonFile" class="form-label">Fichier JSON</label>
        <input type="file" class="form-control" name="jsonFile" id="jsonFile" accept=".json" required>
    </div>
    <button type="submit" class="btn btn-primary">Importer</button>
</form>


<h2>Liste User : </h2>


    @foreach($datas as $data)
        <ul>
            <li>{{ $data->id }}</li>
            <li>{{ $data->name }}</li>
            <li>{{ $data->email }}</li>
        </ul>
        <form action="{{ route('students.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    @endforeach




</body>
</html>
