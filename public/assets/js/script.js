const { ajax } = require("jquery");

(function(win,doc){
    'use strict';
    //delete
    function confirmarDelete(event){
        console.log(event.target.parentNode.href);
        let token=doc.getElementsByName("_token")[0].value;
        if(confirm("Deseja Realmente apagar?")){
            ajax.open("DELETE", event.target.parentNode.href);
            ajax.setRequesHeader('X-CSRF-TOKEN', token);
            ajax.onreadystatechange=function(){
                if(ajax.readyState ===4 && ajax.status===200){
                    win.location.href = "atividade"

                }
            };
            ajax.send();
        }else{
            return false;
        }
    }

    if(doc.querySelector('.j-del')){
        let btn = doc.getSelectorAll('.j-del');
        for(let i=0;i<btn.length;i++){
            btn[i].addEventListener('click', confirmarDelete,false);
        }
    }
})(window,document)