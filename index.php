<?php
    require_once __DIR__ . '/connect.php';

    session_start();

    $stmt = $conn->prepare("SELECT * FROM tasks");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $tasks = $stmt->fetchAll();
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
        <?php
            if (isset($_SESSION['success'])) {
        ?>
                <div class="alert-success">
                    <span><?php echo $_SESSION['success']; ?></span>
                </div>
        <?php
                unset($_SESSION['success']);
            }
            else if (isset($_SESSION['error'])) {
        ?>
                <div class="alert-error">
                    <span><?php echo $_SESSION['error']; ?></span>
                </div>
        <?php
                unset($_SESSION['error']);
            }
        ?>
        <header>
            <h1>Gerenciador de Tarefas</h1>
        </header>
    
        <main>
            <div class="form">
                <?php
                    if (isset($_SESSION['alert-message'])) {
                ?>
                        <div class="alert-message">
                            <span><?php echo $_SESSION['alert-message']; ?></span>
                        </div>
                <?php
                        unset($_SESSION['alert-message']);
                    }
                ?>

                <form action="taskController.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="insert" value="insert">
                    <label for="task_name">Tarefa:</label>
                    <input type="text" name="task_name" id="task_name" placeholder="Nome da tarefa">
                    <label for="task_description">Descrição:</label>
                    <input type="text" name="task_description" id="task_description" placeholder="Descrição da tarefa">
                    <label for="task_date">Data:</label>
                    <input type="date" name="task_date" id="task_date">
                    <label for="task_image">Imagem:</label>
                    <input type="file" name="task_image" id="task_image">
                    <button type="submit">Cadastrar</button>
                </form>
            </div>
    
            
            <?php
                if (count($tasks) > 0) {
            ?>
                    <div class="separator"></div>

                    <div class="task-list">
                        <?php
                            echo "<ul>";
                                foreach ($tasks as $task) {
                                    echo "
                                    <li>
                                        <div class='task_title'><a href='details.php?task_id=" . $task['id'] ."'>" . $task['task_name'] . "</a></div>
                                        <div><button class='btn-remove' onclick='removeTask(" . $task['id'] . ")'>Remover</button></div>
                                    </li>";
                                }
                            echo "</ul>";
                        ?>
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
        function removeTask(taskId) {
            if (confirm('Você realmente deseja remover esta tarefa?')) {
                window.location = 'http://localhost/php-GerenciadorDeTarefas/taskController.php?task_id=' + taskId;
            }
        }
    </script>
</body>
</html>