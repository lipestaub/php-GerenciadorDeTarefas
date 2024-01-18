<?php
    session_start();

    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }

    if (isset($_GET['task_name'])) {
        array_push($_SESSION['tasks'], $_GET['task_name']);
        unset($_GET['task_name']);
    }

    if (isset($_GET['clear'])) {
        unset($_SESSION['tasks']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">

    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Gerenciador de Tarefas</h1>
        </header>
    
        <main>
            <div class="form">
                <form action="" method="get">
                    <label for="task_name">Tarefa:</label>
                    <br>
                    <input type="text" name="task_name" id="task_name" placeholder="Nome da tarefa">
                    <br>
                    <button type="submit">Cadastrar</button>
                </form>
            </div>
    
            
            <?php
                if (isset($_SESSION['tasks'])) {
            ?>
                    <div class="separator"></div>

                    <div class="task-list">
                        <?php
                            echo "<ul>";
                                foreach ($_SESSION['tasks'] as $key=>$task) {
                                    echo "<li>$task</li>";
                                }
                            echo "</ul>";
                        ?>
                        <form action="" method="get">
                            <input type="hidden" name="clear">
                            <button class="btn-clear" type="submit">Limpar Tarefas</button>
                        </form>
                    </div>
            <?php
                }
            ?>
        </main>
    
        <footer>
            <p>Desenvolvido por <a href="https://github.com/lipestaub" target="_blank">@lipestaub</a></p>
        </footer>
    </div>
</body>
</html>