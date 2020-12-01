(function(wind,doc){
    'use strict';

    function confirmarDelete(event){
        event.preventDefault();
        //console.log(event.target.parentNode.href);
        let token = doc.getElementsByName("_token")[0].value;
        if(confirm("Deseja Realmente apagar o curso?")){
            let ajax = new XMLHttpRequest();
            ajax.open("DELETE",event.target.parentNode.href);
            ajax.setRequestHeader('X-CSRF-TOKEN',token);
            ajax.onreadystatechange=function(){
                if(ajax.readyState === 4 && ajax.status === 200){
                    //console.log("aqui");
                    wind.location.href="/cursos";
                }    
            };
            ajax.send();
        }else{
            return false;    
        }
    }
    function confirmarDelete(event){
        event.preventDefault();
        //console.log(event.target.parentNode.href);
        let token = doc.getElementsByName("_token")[0].value;
        if(confirm("Deseja Realmente apagar o Serie?")){
            let ajax = new XMLHttpRequest();
            ajax.open("DELETE",event.target.parentNode.href);
            ajax.setRequestHeader('X-CSRF-TOKEN',token);
            ajax.onreadystatechange=function(){
                if(ajax.readyState === 4 && ajax.status === 200){
                    //console.log("aqui");
                    wind.location.href="/series";
                }    
            };
            ajax.send();
        }else{
            return false;    
        }
    }
    function confirmarDelete(event){
        event.preventDefault();
        //console.log(event.target.parentNode.href);
        let token = doc.getElementsByName("_token")[0].value;
        if(confirm("Deseja Realmente apagar o Turma?")){
            let ajax = new XMLHttpRequest();
            ajax.open("DELETE",event.target.parentNode.href);
            ajax.setRequestHeader('X-CSRF-TOKEN',token);
            ajax.onreadystatechange=function(){
                if(ajax.readyState === 4 && ajax.status === 200){
                    //console.log("aqui");
                    wind.location.href="/turmas";
                }    
            };
            ajax.send();
        }else{
            return false;    
        }
    }
    function confirmarDelete(event){
        event.preventDefault();
        //console.log(event.target.parentNode.href);
        let token = doc.getElementsByName("_token")[0].value;
        if(confirm("Deseja Realmente apagar o Aluno?")){
            let ajax = new XMLHttpRequest();
            ajax.open("DELETE",event.target.parentNode.href);
            ajax.setRequestHeader('X-CSRF-TOKEN',token);
            ajax.onreadystatechange=function(){
                if(ajax.readyState === 4 && ajax.status === 200){
                    //console.log("aqui");
                    wind.location.href="/alunos";
                }    
            };
            ajax.send();
        }else{
            return false;    
        }
    }
    if(doc.querySelector('.delT')){
        let btn = doc.querySelectorAll('.delT');
        for(let i=0;i<btn.length;i++){
            btn[i].addEventListener('click',confirmarDelete,false);
        }
    }
    if(doc.querySelector('.delC')){
        let btn = doc.querySelectorAll('.delC');
        for(let i=0;i<btn.length;i++){
            btn[i].addEventListener('click',confirmarDelete,false);
        }
    }
    if(doc.querySelector('.delS')){
        let btn = doc.querySelectorAll('.delS');
        for(let i=0;i<btn.length;i++){
            btn[i].addEventListener('click',confirmarDelete,false);
        }
    }
    if(doc.querySelector('.delA')){
        let btn = doc.querySelectorAll('.delA');
        for(let i=0;i<btn.length;i++){
            btn[i].addEventListener('click',confirmarDelete,false);
        }
    }

})(window,document);