<?php
    require_once __DIR__ . '/connect.php';

    session_start();

    if (isset($_POST['task_name'])) {
        if ($_POST['task_name'] != "") {

            if (isset($_FILES['task_image'])) {
                $ext = strtolower(substr($_FILES['task_image']['name'], -4));

                $fileName = md5(date('Y.m.d.H.i.s')) . $ext;
                $dir = 'uploads/';

                move_uploaded_file($_FILES['task_image']['tmp_name'], $dir.$fileName);
            }

            $stmt = $conn->prepare("INSERT INTO tasks(task_name, task_description, task_image, task_date) VALUES(:name, :description, :image, :date);");
            $stmt->bindParam('name', $_POST['task_name']);
            $stmt->bindParam('description', $_POST['task_description']);
            $stmt->bindParam('image', $fileName);
            $stmt->bindParam('date', $_POST['task_date']);

            if ($stmt->execute()) {
                $_SESSION['success'] = 'Os dados foram cadastrados!';
            }
            else {
                $_SESSION['error'] = 'Erro: Os dados não foram cadastrados!';
            }
        }
        else {
            $_SESSION['alert-message'] = "O campo 'Nome da tarefa' deve ser preeenchido!";
        }

        header('Location: index.php');
    }

    if (isset($_GET['task_id'])) {
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id;");
        $stmt->bindParam('id', $_GET['task_id']);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'A tarefa foi excluída!';
        }
        else {
            $_SESSION['error'] = 'Erro: A tarefa não foi excluída!';
        }

        header('Location: index.php');
    }
?>