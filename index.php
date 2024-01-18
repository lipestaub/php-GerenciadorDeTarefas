<?php
    session_start();
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
                <?php
                    if (isset($_SESSION['message'])) {
                ?>
                        <div class="message">
                            <span><?php echo $_SESSION['message']; ?></span>
                        </div>
                <?php
                        unset($_SESSION['message']);
                    }
                ?>

                <form action="taskController.php" method="post">
                    <input type="hidden" name="insert" value="insert">
                    <label for="task_name">Tarefa:</label>
                    <input type="text" name="task_name" id="task_name" placeholder="Nome da tarefa">
                    <label for="task_description">Descrição:</label>
                    <input type="text" name="task_description" id="task_description" placeholder="Descrição da tarefa">
                    <label for="task_date">Data:</label>
                    <input type="date" name="task_date" id="task_date">
                    <button type="submit">Cadastrar</button>
                </form>
            </div>
    
            
            <?php
                if ($_SESSION['tasks'] != []) {
            ?>
                    <div class="separator"></div>

                    <div class="task-list">
                        <?php
                            echo "<ul>";
                                foreach ($_SESSION['tasks'] as $taskKey=>$data) {
                                    echo "
                                    <li>
                                        <div class='task_title'><span>" . $data['task_name'] . "<span></div>
                                        <button class='btn-remove' onclick='removeTask($taskKey)'>Remover</button>
                                    </li>";
                                }
                            echo "</ul>";
                        ?>
                        <form action="taskController.php" method="get">
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

    <script>
        function removeTask(key) {
            if (confirm('Você realmente deseja remover esta tarefa?')) {
                window.location = 'http://localhost/php-GerenciadorDeTarefas/taskController.php?task_key=' + key;
            }
        }
    </script>
</body>
</html>