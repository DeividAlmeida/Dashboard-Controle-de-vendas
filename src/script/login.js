document.querySelectorAll('button')[0].addEventListener('click', function () {
    fetch('apis/autentica.php',{
        method: 'POST',
        headers:{
            'Authorization': 'Basic '+btoa(document.querySelectorAll('input[type="text"]')[0].value+':'+document.querySelectorAll('input[type="password"]')[0].value),
            'Content-Type': 'application/json',
        },
        body: true 
    }).then(aa=>aa.text()).then(aa=>{
        if(aa == 1){
            window.location.href = 'index.php'                    
        }else{                                       
            swal("Acesso Negado!", aa, "error");
        }
    })
})