<x-app-layout>
    <x-slot name='header'>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ _('Results')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                <table>
                    <head>
                        <th>#</th>
                        <th>Comment</th>
                        </head>
                        <body>
                            @foreach($list as $results)
                            <tr><td>{{ $results->id }}</td><td>{{ $results->comment }}</td></tr>
                            @endforeach
                        </body>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>








<!-- <!DOCTYPE html> 
<html lang="en"> 
<head> 

    <meta charset="UTF-8"> 

    <title>Laravel Comment</title> 
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" > 

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 

</head> 

<body> 

 
<div class="container mt-2"> 

    <div class="row"> 
        <div class="col-md-12 card-header text-center font-weight-bold"> 
            <h2>Testing111</h2> 

        </div> 

        <div id="message"></div> 
        <div class="col-md-12 mt-1 mb-2"><button type="button" id="addNewComment" class="btn btn-success">Add</button></div> 

        <div class="col-md-12"> 

            <table id="Table1" class="table"> 

                <thead> 

                    <tr> 

                        <th scope="col"></th> 
                        <th scope="col">#</th> 
                        <th scope="col">Comment</th>

                    </tr> 

                </thead>
                <tbody>  
            
                </tbody> 

            </table> 

            <input id = "btnGet" type="button" value="Get Selected" /> 

        </div> 

    </div>  

    <div><textarea id="messageList" rows="10" cols="100">Selection</textarea> <button type="button" id="copy">Copy</button></div> 

</div> 


<!-- boostrap model --> 

<div class="modal fade" id="comment-bank-model" aria-hidden="true"> 
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <h4 class="modal-title" id="CommentBankModel"></h4> 

            </div> 

            <div class="modal-body"> 
                <ul id="msgList"></ul> 

                <form action="javascript:void(0)" id="addEditCommentForm" name="addEditCommentForm" class="form-horizontal" method="POST"> 
                    <input type="hidden" name="id" id="id"> 
                    <div class="form-group"> 
                        <label for="name" class="col-sm-4 control-label">Comment</label> 
                        <div class="col-sm-12"> 
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Comment" value="" maxlength="50" required=""> 

                        </div> 
                    </div>  

                    <div class="col-sm-offset-2 col-sm-10"> 
                        <button type="submit" class="btn btn-primary" id="btn-add" value="addNewBook">Save
                        </button> 

                        <button type="submit" class="btn btn-primary" id="btn-save" value="UpdateBook">Save changes
                        </button> 
                    </div> 
                </form> 
            </div> 

            <div class="modal-footer"></div> 

        </div> 

    </div> 

</div> 

 

<!-- end bootstrap model --> 

<script> 

    $(document).ready(function($){ 
    fetchResultsComments(); // Get the table from the dB to start 
    $.ajaxSetup({ 

        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        } 
    }); 

    function fetchResultsComments() 

    { 
        // ajax 
        $.ajax({ 
            type:"GET", 
            url: "fetch-comments", 
            dataType: 'json', 

            success: function(res){ 

                // console.log(res); 
                $('tbody').html(""); 
                $.each(res.books, function (key, item) { 
                    $('tbody').append('<tr>\ 
                    <td>' + item.id + '</td>\ 
                    <td>' + item.comment + '</td>\ 

                    <td><button type="button" data-id="' + item.id + '" class="btn btn-primary edit btn-sm">Edit</button>\ 
                    <button type="button" data-id="' + item.id + '" class="btn btn-danger delete btn-sm">Delete</button></td>\ 
                    </tr>'); 

                }); 
            }, 

            complete: function(){ 
                isChecked(); 
            } 
        }); 
    } 

    $('#addNewComment').click(function (evt) { 
        evt.preventDefault();

        $('#addEditCommentForm').trigger("reset"); 
        $('#ajaxBookModel').html("Add Comment"); 
        $('#btn-add').show(); 
        $('#btn-save').hide(); 
        $('#comment-bank-model').modal('show'); 

    }); 

    
    

    $('body').on('click', '#btn-add', function (event) { 
        event.preventDefault(); 
        var title = $("#comment").val();
        $("#btn-add").html('Please Wait...'); 
        $("#btn-add").attr("disabled", true); 

        // ajax 
        $.ajax({ 

            type:"POST", 

            url: "save-comment", 
            data: { 
                comment:comment,
            }, 

            dataType: 'json', 

            success: function(res){ 
                console.log(res); 
                if (res.status == 400) { 

                    $('#msgList').html(""); 
                    $('#msgList').addClass('alert alert-danger'); 
                    $.each(res.errors, function (key, err_value) { 
                        $('#msgList').append('<li>' + err_value + '</li>'); 

                    }); 

                    $('#btn-save').text('Save changes'); 

                } else { 
                    $('#message').html(""); 
                    $('#message').addClass('alert alert-success'); 
                    $('#message').text(res.message); 
                    fetchBook(); 
                } 
            }, 

            complete: function(){ 
                $("#btn-add").html('Save'); 
                $("#btn-add").attr("disabled", false); 
                $("#btn-add").hide(); 
                $('#comment-bank-model').modal('hide'); 
                $('#message').fadeOut(4000); 

            } 
        }); 
    }); 

    $('body').on('click', '.edit', function (evt) { 
        evt.preventDefault(); 
        var id = $(this).data('id'); 

        // ajax 
        $.ajax({ 

            type:"GET", 
            url: "edit-comment/"+id, 
            dataType: 'json', 

            success: function(res){ 
                console.dir(res); 
                $('#CommentBankModel').html("Edit Comment"); 
                $('#btn-add').hide(); 
                $('#btn-save').show(); 
                $('#comment-bank-model').modal('show'); 

                if (res.status == 404) { 
                    $('#msgList').html(""); 
                    $('#msgList').addClass('alert alert-danger'); 
                    $('#msgList').text(res.message); 

                } else { 
                    // console.log(res.book.xxx); 
                    $('#title').val(res.comment.comment);
                } 
            } 
        }); 
    }); 

    $('body').on('click', '.delete', function (evt) { 
        evt.preventDefault(); 
        if (confirm("Delete Comment?") == true) { 
            var id = $(this).data('id'); 

            // ajax 
            $.ajax({ 

                type:"DELETE", 
                url: "delete-comment/"+id, 
                dataType: 'json', 

                success: function(res){ 

                    // console.log(res); 
                    if (res.status == 404) { 
                        $('#message').addClass('alert alert-danger'); 
                        $('#message').text(res.message); 
                    } else { 
                        $('#message').html(""); 
                        $('#message').addClass('alert alert-success'); 
                        $('#message').text(res.message); 
                    } 
                    fetchResultsComments(); 
                } 
            }); 
        } 
    }); 

    $('body').on('click', '#btn-save', function (event) { 

        event.preventDefault(); 
        var id = $("#id").val(); 
        var comment = $("#comment").val();

        // alert("id="+id+" title = " + title); 
        $("#btn-save").html('Please Wait...'); 
        $("#btn-save").attr("disabled", true); 

        // ajax 

        $.ajax({ 

            type:"PUT", 
            url: "update-comment/"+id, 
            data: { 
            comment:comment,
            }, 

            dataType: 'json', 
            success: function(res){ 

                console.log(res); 

                if (res.status == 400) { 
                    $('#msgList').html(""); 
                    $('#msgList').addClass('alert alert-danger'); 

                    $.each(res.errors, function (key, err_value) { 
                        $('#msgList').append('<li>' + err_value + '</li>'); 

                    }); 
                    $('#btn-save').text('Save changes'); 

                } else { 
                    $('#message').html(""); 
                    $('#message').addClass('alert alert-success'); 
                    $('#message').text(res.message); 
                    fetchBook(); 
                } 

            }, 

            complete: function(){ 
                $("#btn-save").html('Save changes'); 
                $("#btn-save").attr("disabled", false); 
                $('#comment-bank-model').modal('hide'); 
                $('#message').fadeOut(4000); 

            } 
        }); 
    }); 

    $("#btnGet").click(function () { 
    var message = ""; 

    //Loop through all checked CheckBoxes in GridView. 

    $("#Table1 input[type=checkbox]:checked").each(function () { 
        var row = $(this).closest("tr")[0]; 
        // message += row.cells[2].innerHTML; 
        message += " " + row.cells[3].innerHTML; 
        // message += " " + row.cells[4].innerHTML; 
        message += "\n-----------------------\n"; 
    });

    //Display selected Row data in Alert Box. 

    $("#messageList").html(message); 

    return false; 

    }); 
    $("#copy").click(function(){ 
    $("#messageList").select(); 
    document.execCommand("copy");  
    alert("Copied On clipboard"); 

    }); 

    
    

    function isChecked(){ 

        $("#Table1 input[type=checkbox]").each(function () { 

            if ($(this).val() == 1) 
            { 
                $(this).prop("checked", true); 
            } 

            else 
            { 
                $(this).prop("checked", false); 
            } 
        }); 

        } 
    }); 

    

</script> 

</body> 

</html>  -->