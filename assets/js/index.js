$(document).ready(function () {
    $('#submitForm').click(function () {
        var login = $('#registerUsername').val();
        var password = $('#registerPass').val();
        var password2 = $('#registerPass2').val();
        var email = $('#registerEmail').val();
        $.ajax({
            url: './submit-register.php',
            method: 'POST',
            dataType: 'json',
            data: {
                login: login,
                password: password,
                password2: password2,
                email: email,
            },
            success: function (response) {
                if (response.length == 0) {
                    $('.alert-success').fadeIn('slow');
                    $('.alert-success').delay(2000).fadeOut('slow');
                    setTimeout(function () {
                        window.top.location = "./index.php"
                    }, 2000);
                } else {
                    $('.alert-danger').text(response);
                    $('.alert-danger').fadeIn('slow');
                    $('.alert-danger').delay(3000).fadeOut('slow');
                }
            }
        });
        return false;
    });

    $('#submitLogin').click(function () {
        var email = $('#loginEmail').val();
        var password1 = $('#loginPass').val();
        $.ajax({
            url: './submit-auth.php',
            method: 'POST',
            dataType: 'json',
            data: {
                email: email,
                password: password1,
            },
            success: function (response) {
                if (response.length == 0) {
                    $('.alert-success').fadeIn('slow');
                    $('.alert-success').delay(2000).fadeOut('slow');
                    setTimeout(function () {
                        window.top.location = "./users-list.php"
                    }, 2000);
                } else {
                    $('.alert-danger').text(response);
                    $('.alert-danger').fadeIn('slow');
                    $('.alert-danger').delay(3000).fadeOut('slow');
                }
            }
        });
        return false;
    });

    $('#submitRoom').click(function () {
        var newroom = $('#nameRoom').val();
        $.ajax({
            url: './create-room.php',
            method: 'POST',
            dataType: 'json',
            data: {
                newroom: newroom,
            },
            success: function (response) {
                if (response.length == 0) {
                    $('.alert-success').fadeIn('slow');
                    $('.alert-success').delay(2000).fadeOut('slow');
                    setTimeout(function () {
                        window.top.location = "./users-list.php"
                    }, 2000);
                } else {
                    $('.alert-danger').text(response);
                    $('.alert-danger').fadeIn('slow');
                    $('.alert-danger').delay(3000).fadeOut('slow');
                }
            }
        });
        return false;
    });

    $('input[name="checked[]"]').click(function () {
        if ($(this).is(':checked')) {
            $("#deleteuser").prop("disabled", false);
            $("#blockuser").prop("disabled", false);
        } else {
            $("#deleteuser").prop("disabled", true);
            $("#blockuser").prop("disabled", true);
        }
    });
    $('#maincheck').click(function () {
        if ($(this).is(':checked')) {
            $('input[name="checked[]"]').prop('checked', true);
            $("#deleteuser").prop("disabled", false);
            $("#blockuser").prop("disabled", false);
        } else {
            $('input[name="checked[]"]').prop('checked', false);
            $("#deleteuser").prop("disabled", true);
            $("#blockuser").prop("disabled", true);
        }

    });
    function rand(min, max) {

        if (max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        } else {
            return Math.floor(Math.random() * (min + 1));
        }
    }

    var button = document.getElementById('createRoomIcon');
    var count = rand(1, 10000000);
    button.onclick = function () {
        var input = document.createElement('input');
        input.type = 'text';
        input.setAttribute("data-id", "id" + count);
        input.setAttribute("id", "nameRoom");
        input.value = 'Room № ' + count;
        document.querySelector('.inputs').appendChild(input);
        document.querySelector('.button-save').style.display = "block";
        button.style.pointerEvents = "none";
        button.style.color = 'rgb(239, 239, 239)';
        document.querySelector('.title-icon-room').style.color = 'rgb(239, 239, 239)';
    };
    var el = $('td[name="nameroomedit[]"]');
    $(document).click(function () {
        $(".fa-pencil").css("opacity", "1");
    });
    $(el).click(function (event) {
        if ($(".fa-pencil").css("opacity") === "1") {
            $(".fa-pencil").css("opacity", "0")
        } else {
            $(".fa-pencil").css("opacity", "0")
        }
        event.stopPropagation();
    });

    $('td[name="nameroomedit[]"]').blur(function () {
        var editroom = $(this).text();
        var editroomid = $(this).prev().text();
        $.ajax({
            url: './edit-room.php',
            method: 'POST',
            dataType: 'json',
            data: {
                newroom: editroom,
                id_room: editroomid,
            },
            success: function (response) {
                if (response.length == 0) {
                    $('.edit-message').fadeIn('slow');
                    $('.edit-message').delay(2000).fadeOut('slow');
                    setTimeout(function () {
                        window.top.location = "./users-list.php"
                    }, 2000);
                }
            }
        });
        return false;
    });
    $('a[name="nameroomdelete[]"]').click(function () {
        var deleteid = $(this).attr("data-id");
        $.ajax({
            url: './delete-room.php',
            method: 'POST',
            dataType: 'json',
            data: {
                id_room: deleteid,
            },
            success: function (response) {
                if (response.length == 0) {
                    $('.delete-message').fadeIn('slow');
                    $('.delete-message').delay(2000).fadeOut('slow');
                    setTimeout(function () {
                        window.top.location = "./users-list.php"
                    }, 2000);
                }
            }
        });
        return false;
    });
});

var cnv = document.getElementById('canvas');
var sendCanvas = function (cnv) {
    var img = cnv.toDataURL('image/png').replace('data:image/png;base64,', '');
    var sender = new XMLHttpRequest();
    sender.open('POST', 'send-canvas.php', true);
    sender.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    sender.send('img=' + img);

    var idroom = document.getElementById('getidroom').textContent;
    idroom = 'room_'+ idroom;
    var send = new XMLHttpRequest();
    send.open('GET', 'send-canvas.php?id_room='+idroom , true);
    send.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    send.send(idroom);
};
cnv.onclick = function () {
    sendCanvas(cnv);
}
