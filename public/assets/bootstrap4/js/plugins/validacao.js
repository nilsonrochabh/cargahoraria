function validarCPF(cpf,divRetorno,objFoco) 
{  
    if (cpf != '')
    {
        var controle = true;
        cpf = cpf.replace(/[^\d]+/g,'');    
        if(cpf === '') return false; 
        // Elimina CPFs invalidos conhecidos    
        if (cpf.length !== 11 || 
            cpf === "00000000000" || 
            cpf === "11111111111" || 
            cpf === "22222222222" || 
            cpf === "33333333333" || 
            cpf === "44444444444" || 
            cpf === "55555555555" || 
            cpf === "66666666666" || 
            cpf === "77777777777" || 
            cpf === "88888888888" || 
            cpf === "99999999999")
                controle = false;       
        // Valida 1o digito 
        add = 0;    
        for (i=0; i < 9; i ++)       
            add += parseInt(cpf.charAt(i)) * (10 - i);  
            rev = 11 - (add % 11);  
            if (rev === 10 || rev === 11)     
                rev = 0;    
            if (rev !== parseInt(cpf.charAt(9)))     
                controle = false;      
        // Valida 2o digito 
        add = 0;    
        for (i = 0; i < 10; i ++)        
            add += parseInt(cpf.charAt(i)) * (11 - i);  
        rev = 11 - (add % 11);  
        if (rev === 10 || rev === 11) 
            rev = 0;    
        if (rev !== parseInt(cpf.charAt(10)))
            controle = false;      
        
        if(!controle)
        {
          $(objFoco).addClass('is-invalid');
          $(objFoco).val('');
          $(objFoco).focus();   
          $(divRetorno).text('CPF inválido. Digite apenas números.');
        } else
        {
          $(objFoco).removeClass('is-invalid');
          $(divRetorno).text('');
        }

        return controle;  
    }
    
}

function IsEmail(email,divRetorno,objFoco)
{
    if (email != '')
    {
        var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;    
        if(!filter.test(email)){
            $(objFoco).addClass('is-invalid');
            $(objFoco).val('');
            $(objFoco).focus();   
            $(divRetorno).text('E-mail inválido.');
            return false;
        } else
        {
            $(objFoco).removeClass('is-invalid');
            $(divRetorno).text('');
            return true;
        }
            
    }
}

function verificarCampoBrancoNome(str,divRetorno,objFoco)
{
    var s = str.trim();
    if (s == '')
    {   
        $(objFoco).removeClass('is-invalid');
        $(divRetorno).text('');
        return true;
    }
        
    var n = s.search(" ");
    if (n == -1)
    {
        $(objFoco).addClass('is-invalid');
        $(objFoco).val('');
        $(objFoco).focus();   
        $(divRetorno).text('Digite o nome completo no campo acima.');
        return false;
    }
    else
    {
        $(objFoco).removeClass('is-invalid');
        $(divRetorno).text('');
        return true;
    }
        
}

function validarData(data,divRetorno,objFoco)
{
    if (data != '')
    {        

        var dia = data.substring(0,2)
        var mes = data.substring(3,5)
        var ano = data.substring(6,10)

        var novaData = new Date(ano,(mes-1),dia);
     
        var mesmoDia = parseInt(dia,10) == parseInt(novaData.getDate());
        var mesmoMes = parseInt(mes,10) == parseInt(novaData.getMonth())+1;
        var mesmoAno = parseInt(ano) == parseInt(novaData.getFullYear());
     
        if (!((mesmoDia) && (mesmoMes) && (mesmoAno)))
        {
            $(objFoco).addClass('is-invalid');
            $(objFoco).val('');
            $(objFoco).focus();  
            $(divRetorno).text('Data inválida.');  
            return false;
        } else
        {
          $(objFoco).removeClass('is-invalid');
          $(divRetorno).text(''); 
          return true;    
        } 
        
    }
}

function formatarData(data){
    var ano = data.substring(0,4)
    var mes = data.substring(5,7)
    var dia = data.substring(8,10)
    return dia+'/'+mes+'/'+ano; 
}