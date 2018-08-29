<?php require_once("header.php"); require_once("function.php");
session_start();
if(isset($_POST['delete'])){
    Form::deleteUser($dbh);
}
if(isset($_POST['block'])){
    Form::blockUser($dbh);
}
?>
<div class="container">
    <form method="POST">
        <div class="row mt-3 mb-3">
            <div class="col-md-3 flex-center">
                <button type="submit" name="block" class="btn btn-outline-primary" id="blockuser" disabled>
                    <span>
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </button>
                <button type="submit" name="delete" id="deleteuser" class="btn btn-outline-danger" disabled>
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </div>
            <div class="col-md-4 flex-center">
            <?php if (isset($_SESSION['username']))
                echo '<div class="room-control">
                    <input type="button" id="createRoom">
                    <i class="fa fa-plus-circle" id="createRoomIcon" aria-hidden="true"></i>
                    </button>
                    <a class="title-icon-room">Create room</a>
                </div>'; ?>
            </div>
            <div class="col-md-5 flex-center-session">
                <div class="session-user">
                <?php if (isset($_SESSION['username'])) {
                    echo '<a class="title-session-user">Hello, '.$_SESSION['username'].'</a> <br>
                        <a href="logout.php">Log Out</a>';} ?> 
                    </div>
                </div>
            </div>
        <div class="row">
            <?php
            $result = Form::getAllUsers($dbh);
            echo '<table class="table">
            <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="maincheck"></th>
                <th scope="col">ID user</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
            </tr>
            </thead>';
            foreach ($result as $row){
                $col2 = 0;
                $row['status'] == 1 ? $col2= "#ff00004a" : $col2 = "0";
                echo '<tbody>
                <tr style="background-color:'.$col2.'";>
                    <th scope="row"><input type="checkbox" id="checkbox" name="checked[]" value="'.$row['user_id'].'"  aria-label="Checkbox for following text input"></th>
                    <td>'.$row['user_id'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['email'].'</td>
                    <td class="status">'.(($row['status'] != 0 ) ? "Block" : "Unblock").'</td>
                </tr>
                </tbody>';}
            echo '</table>';?>
        </div>
    </form>
    <form>
        <div class="row">
            <div class="col-md-12 text-left mt-4 pl-0 wrapper-room">
                <div class="alert alert-danger" role="alert">
                    Room is not created!
                </div>
                <div class="alert alert-success" role="alert">
                    Room is created!
                </div>
                <div class="alert alert-info edit-message" role="alert">
                    Name room was changed !
                </div>
                <div class="alert alert-dark delete-message" role="alert">
                    Name room was deleted!
                </div>
                <div class="inputs">
                </div>
                <button type="submit" id="submitRoom" class="btn btn-primary mt-2 button-save">Save</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12 mt-4 pl-0">
        <?php
            $getrooms = Form::getAllRooms($dbh);
            echo '<table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">ID room</th>
                <th scope="col">Name room</th>
                <th scope="col">Name created</th>
                <th scope="col"></th>
            </tr>
            </thead>';
            foreach ($getrooms as $row){
                echo '<tbody>
                <tr>
                <td><a href="rooms.php?id_room='.$row['id_room'].'"><i class="fa fa-sign-in" aria-hidden="true"></i></a></td>
                    <td>'.$row['id_room'].'</td>
                    <td name="nameroomedit[]" contenteditable="true">'.$row['name_room'].' <i class="fa fa-pencil" aria-hidden="true"></i></td>
                    <td>'.$row['username'].'</td>
                    <td style="cursor:pointer;"><a name="nameroomdelete[]" data-id="'.$row['id_room'].'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                </tbody>';}
            echo '</table>';?>
        </div>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/index.js"></script>
    </body>

    </html>