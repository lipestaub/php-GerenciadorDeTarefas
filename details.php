<?php
    require_once __DIR__ . '/connect.php';

    session_start();

    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id;");
    $stmt->bindParam('id', $_GET['task_id']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $task = $stmt->fetchAll()[0];
?>

<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">

    <title>Tarefa</title>
</head>
<body>
    <div class="details-container">
        <header>
            <h1><?php echo $task['task_name']; ?></h1>
        </header>

        <main class="row">
            <div class="details">
                <dl>
                    <dt>Descrição da tarefa:</dt>
                    <dd><?php echo $task['task_description']; ?></dd>
                    <dt>Data da tarefa:</dt>
                    <dd><?php echo $task['task_date']; ?></dd>
                </dl>
            </div>
            <div class="image">
                <img src="uploads/<?php echo $task['task_image']; ?>" alt="Imagem da tarefa">
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="https://github.com/lipestaub" target="_blank">@lipestaub</a></p>
        </footer>
    </div>
</body>
</html>