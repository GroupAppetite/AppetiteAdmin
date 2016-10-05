$(document).ready(function(){

    entry.init();

});

var entry ={

    data : {
        lastID         : 0,
        noActivity    : 0
    },


    init : function(){
        // Self executing timeout functions

        (function getChatsTimeoutFunction(){
            entry.getChats(getChatsTimeoutFunction);
        })();

    },


    render : function(params){

        var arr = ['<div class = "prenotazione"><p>',params.nome,' ',params.cognome,'</p></div>'];


        // A single array join is faster than
        // multiple concatenations

        return arr.join('');

    },

    addLine : function(params){
    
        // All times are displayed in the user's timezone
    
        var markup = entry.render(params);
    
        if(!entry.data.lastID){
            // If this is the first entry, remove the
            // paragraph saying there aren't any:
    
            $('#chatLineHolder p').remove();
        }
    
        // If this isn't a temporary entry:
        if(params.id.toString().charAt(0) != 't'){
            var previous = $('.prenotazione');//+(+params.id - 1));
            if(previous.length){
                previous.after(markup);
            }
            else entry.data.jspAPI.getContentPane().append(markup);
        }
        else entry.data.jspAPI.getContentPane().append(markup);
    
        // As we added new content, we need to
        // reinitialise the jScrollPane plugin:
    
        entry.data.jspAPI.reinitialise();
        entry.data.jspAPI.scrollToBottom(true);
    
    },
    
    getChats : function(callback){
    
         //GET non rilevato
         $.tzGET('getChats',{lastID: entry.data.lastID},function(r){
    
             for(var i=0;i<r.chats.length;i++){
                 entry.addLine(r.chats[i]);
             }
    
             if(r.chats.length){
                 entry.data.noActivity = 0;
                 entry.data.lastID = r.chats[i-1].id;
             }
             else{
                 // If no chats were received, increment
                 // the noActivity counter.
    
                 entry.data.noActivity++;
             }

             // Setting a timeout for the next request,
             // depending on the entry activity:
    
             var nextRequest = 1000;
    
             // 2 seconds
             if(entry.data.noActivity > 3){
                 nextRequest = 2000;
             }
    
             if(entry.data.noActivity > 10){
                 nextRequest = 5000;
             }
    
             // 15 seconds
             if(entry.data.noActivity > 20){
                 nextRequest = 15000;
             }
    
             setTimeout(callback,nextRequest);
         });
     },
}


$.tzPOST = function(action,data,callback){
    $.post('php/ajax.php?action='+action,data,callback,'json');
}

$.tzGET = function(action,data,callback){
    $.get('php/ajax.php?action='+action,data,callback,'json');
}
