<?php
    session_start();

    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }

    if (isset($_POST['task_name'])) {
        if ($_POST['task_name'] != "") {

            if (isset($_FILES['task_image'])) {
                $ext = strtolower(substr($_FILES['task_image']['name'], -4));

                $fileName = md5(date('Y.m.d.H.i.s')) . $ext;
                $dir = 'uploads/';

                move_uploaded_file($_FILES['task_image']['tmp_name'], $dir.$fileName);
            }

            $data = [
                'task_name' => $_POST['task_name'],
                'task_description' => $_POST['task_description'],
                'task_date' => $_POST['task_date'],
                'task_image'=> $fileName
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

    if (isset($_GET['task_id'])) {
        unset($_SESSION['tasks'][$_GET['task_id']]);
        unset($_GET['task_id']);

        header('Location: index.php');
    }
?>