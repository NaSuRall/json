<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Json Dashboard</title>
</head>
<body>
<style>
    /* Réinitialisation des styles de base */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
        text-align: center;
    }

    /* Conteneur principal */
    .container {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    /* Titres */
    h1, h2 {
        color: #333;
    }

    /* Messages de succès et d'erreur */
    .alert {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 5px solid #28a745;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 5px solid #dc3545;
    }

    /* Formulaire */
    form {
        margin-bottom: 20px;
    }

    form label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        text-align: left;
    }

    input[type="file"] {
        display: block;
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    /* Boutons */
    button {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    /* Bouton principal */
    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Bouton de suppression avec icône */
    .btn-danger {
        background-color: #dc3545;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-danger:hover {
        background-color: #a71d2a;
    }

    .btn-danger i {
        font-size: 18px;
    }

    /* Liste des utilisateurs */
    ul {
        list-style: none;
        padding: 0;
        background: #fff;
        margin: 10px auto;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        text-align: left;
    }

    li {
        padding: 5px 0;
        border-bottom: 1px solid #ddd;
    }

    li:last-child {
        border-bottom: none;
    }
    .card{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 300px;
        height: 300px;
    }
    /* Grille des utilisateurs */
    .user-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 20px;
        padding: 50px;
        flex-wrap: wrap;
    }

    /* Carte utilisateur */
    .user-card {
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    /* Texte dans la carte */
    .user-card p {
        margin: 5px 0;
        font-size: 16px;
        width: 100%;
        height: 50px;
    }

    /* Bouton de suppression */
    .btn-danger {
        background-color: #dc3545;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        font-size: 14px;
        width: 100%;
    }

    .btn-danger:hover {
        background-color: #a71d2a;
    }

    /* Icône de la poubelle */
    .btn-danger i {
        font-size: 16px;
    }

</style>


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
        <button type="submit" class="btn btn-primary">Importer</button>
    </div>

</form>


<h2>Liste User : </h2>


<div class="user-grid">
    @foreach($datas as $data)
        <div class="user-card">
            <p><strong>ID :</strong> {{ $data->id }}</p>
            <p><strong>Nom :</strong> {{ $data->name }}</p>
            <p><strong>Email :</strong> {{ $data->email }}</p>
            <form action="{{ route('students.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa-solid fa-trash"></i> Supprimer
                </button>
            </form>
        </div>
    @endforeach
</div>

</body>
</html>
