$(document).ready(function(){

    entry.init();

    if (Notification.permission !== "granted"){    
        Notification.requestPermission();
    }

});

var entry ={

    stats : {
        lastID : 0,
        noActivity : 0
    },


    render : function(params){

        var previous = $('#p'+entry.stats.lastID);

        var arr = ['<div id ="p',params.numero,'"" class = "prenotazione"><p>',params.nome,' ',params.cognome,'</p></div>'];
        // A single array join is faster than
        // multiple concatenations

        var div =arr.join('');

        previous.before(div);

        entry.stats.lastID = params.numero;
        entry.stats.noActivity = 0;

    },


    update : function(){

        $.get("mode/ajax.php?action=getChats&lastid="+entry.stats.lastID,function(data) {

            var obj = JSON.parse(data)
            
            if (obj.chats.length!=0){
                if(entry.stats.lastID != 0){
                    notifyMe();
                }
                obj.chats.forEach(entry.render);
            } else {
                entry.stats.noActivity++;
            }

            var nextRequest = 1000;

            // 2 seconds
            if(entry.stats.noActivity > 3){
                nextRequest = 2000;
            }

            if(entry.stats.noActivity > 10){
                nextRequest = 5000;
            }

            // 15 seconds
            if(entry.stats.noActivity > 20){
                nextRequest = 15000;
            }

            
            setTimeout(entry.update,nextRequest);
        });
    },

    init : function(){
        // Self executing timeout functions
        entry.update();        

    },

    
}

function notifyMe() {
  if (!Notification) {
    alert('Notifiche non disponibili su questo browser, si consiglia di usare un altro browser (ad esempio Google Chrome)'); 
    return;
  }

  if (Notification.permission !== "granted")
    Notification.requestPermission();
  else {
    var notification = new Notification('Appetite', {
      icon: 'https://placeholdit.imgix.net/~text?txtsize=28&bg=0099ff&txtclr=ffffff&txt=300%C3%97300&w=300&h=300&fm=png',
      body: "Ci sono nuove prenotazioni da controllare!",
    });

    notification.onclick = function () {
      window.open("http://apparecchiotest.co.nf/?mode=prenotazioni");      
    };
    
  }

}