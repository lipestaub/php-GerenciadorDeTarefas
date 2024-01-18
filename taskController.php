<?php
    session_start();

    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }

    if (isset($_POST['task_name'])) {
        if ($_POST['task_name'] != "") {
            $data = [
                'task_name' => $_POST['task_name'],
                'task_description' => $_POST['task_description'],
                'task_date' => $_POST['task_date']
            ];

            array_push($_SESSION['tasks'], $data);

            unset($_POST['task_name']);
            unset($_POST['task_description']);
            unset($_POST['task_date']);
        }
        else {
            $_SESSION['message'] = "O campo 'Nome da tarefa' deve ser preeenchido!";
        }

        header('Location: index.php');
    }

    if (isset($_GET['clear'])) {
        $_SESSION['tasks'] = [];

        header('Location: index.php');
    }

    if (isset($_GET['task_key'])) {
        unset($_SESSION['tasks'][$_GET['task_key']]);
        unset($_GET['task_key']);

        header('Location: index.php');
    }
?>