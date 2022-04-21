function editMSG(message_id){
        
    let message = $("#mess_" + message_id +" > div > div > p").text();

    $("#userinput").val($.trim(message));
    $('#userinput').trigger('keyup');
    $("#msgEditID").val("" + message_id);
    $("#send").addClass("icon");
}

function deleteMSG(message_id){
    let url = `../public/api.php?deleteMSG=true&message_id=${message_id}`

    $.get({
        url : url
        
    });
}

$(function(){

    const permission = $("#permission").val();

    function showAllMessages(){
        let parent = $("#chat-content");
        let url = '../public/api.php?showmessage=true';
        let currentUser = $("#username").val();
        $.get({
            url: url,
            success : function(response){
                
                parent.html(" ");
                response.forEach(data => {
                    let image_tag = "";
                    var actionBtn   = "";

                    if (typeof data.image_src !== 'undefined') {
                        image_tag = `<div style="display:block;"><img src="${data.image_src}"></div>`;
                    }

                    if (data.sender == currentUser && typeof data.image_src == 'undefined')
                        actionBtn = `<button type="button" onclick="editMSG(${data.id})" class="btn btn-outline-secondary edit-btn"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16"><path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"></path></svg></button><button type="button" onclick="deleteMSG(${data.id})" class="btn btn-danger edit-btn"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-file-x" viewBox="0 0 16 16"><path d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707 6.854 9.854a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708z"/><path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/></svg></button>`;
                    else if(data.sender == currentUser && typeof data.image_src !== 'undefined' )
                        actionBtn = `<button type="button" onclick="deleteMSG(${data.id})" class="btn btn-danger edit-btn"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-file-x" viewBox="0 0 16 16"><path d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707 6.854 9.854a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708z"/><path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/></svg></button>`;

                    if (permission == "admin" && data.sender != "admin" ){
                        actionBtn += `<button type="button" onclick="blockUSER('${data.sender}')" class="btn btn-outline-danger edit-btn"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/></svg></button>`;
                    }

                    parent.append(`
                            <div class="media media-chat"> 
                                <div class="media-body" id="mess_${data.id}">
                                    <div>
                                        <small>${data.sender}</small>
                                        <div class="message-container">
                                        <p>${data.text_message}
                                        ${image_tag}</p>
                                        ${actionBtn}
                                        
                                        </div>
                                    </div>
                                    <p class="meta"><time datetime="2018">${data.date}</time></p>
                                </div>
                            </div>
                    `);
                });


                parent.append(`
                            <div class="ps-scrollbar-x-rail" id="scroll" style="left: 0px; bottom: 0px;">
                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
                            </div>
                `);
                $('#chat-content').scrollTo('#scroll');
            }
        });
    }
    function insertDataToJson(image_src = "null",notNewMessage=false){
        let url =  '../public/api.php'
        let text_message = $("#userinput").val();
        let sender       = $("#sender").val();
        
        if (notNewMessage == true){
            let message_id = $("#msgEditID").val();
            
            var data = {
                username   : sender,
                text       : text_message,
                message_id : message_id
            }

            // empty message id hidden input so it gets ready for next user action :)
            $("#msgEditID").val('')
            $("#send").removeClass("icon");
            
        }else{
            var data = {
                username : sender,
                text : text_message
            }
        }


        
        if(image_src !== "null"){
            data['image_src'] = image_src;
        }
        
        console.log(data);
        showAllMessages();

         $.post({
            url: url,
            data: data,
            success : function(response){
                $("#userinput").val("");
                $("#userinput").focus();
                
                showAllMessages()
            }
        }); 
    }
    
    $("#send").click(function (){

        if ($("#msgEditID").val() !== "")
            insertDataToJson("null",true);
        else
            insertDataToJson(); 
    
    });


    $("#userinput").on('keypress', function(e){
        if(e.which != 13 && e.which != 8 && e.which != 46 ){
            charac = $("#chCounter").text();
            charac = parseInt(charac);

            if (charac>=100){
                $("#chCounter").removeClass("font-color-orange");
                $("#chCounter").addClass("font-color-red");
                e.preventDefault();
            }
            

        }
        

    });

    $("#userinput").on('keyup',function(e) {
        
        handleInputChange(e);
        
    });

 
    
    

    function handleInputChange(e){


        if(e.which == 13) {
            $("#chCounter").text("0");
            $("#chCounter").removeClass("font-color-red");
            $("#chCounter").removeClass("font-color-orange");

            if ($("#msgEditID").val() !== "")
                insertDataToJson("null",true);
            else
                insertDataToJson(); 
        }
        if(e.which != 13){
            
            $("#chCounter").text($("#userinput").val().length);
            charac = $("#chCounter").text();
            charac = parseInt(charac);

            if (charac>=100){
                $("#chCounter").removeClass("font-color-orange");
                $("#chCounter").addClass("font-color-red");

            }
            else if(charac>=50){
                $("#chCounter").removeClass("font-color-red");
                $("#chCounter").addClass("font-color-orange");
            }
            else if(charac<49){
                $("#chCounter").removeClass("font-color-red");
                $("#chCounter").removeClass("font-color-orange");
            }
        }
            
    }

    $("#file").change(function(e){
        var file_data = $('#file').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        
        $.ajax({
            url: '../public/uploadFile.php', // <-- point to server-side PHP script 
            dataType: 'text',  // <-- what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                insertDataToJson(php_script_response)
                console.log(php_script_response); // <-- display response from the PHP script, if any
            }
         });
    });

    

    //setInterval(showAllMessages, 1000);
    setTimeout(showAllMessages,1000);
    //showAllMessages();
})