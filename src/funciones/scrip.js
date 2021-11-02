$( document ).ready(function() {


  $('#enventSearch').on('click', async ( event )=>{

    event.preventDefault();
    let text = document.getElementById("text").value;
    
    try{
      let result = await sendData( text );
      viewResult( result );
      //console.log( result ); //DESCOMENTAR PARA VER INFO EN CONSOLA.
    }catch( err ){
      //console.error( err );  //DESCOMENTAR PARA VER INFO EN CONSOLA.
    }

  });


  //EVENT LOAD FILE VIEW
  //document.getElementById("filepicker").addEventListener("change", function(event) {
    //let output = document.getElementById("listing");
    //let files = event.target.files;

    //for (let i=0; i<files.length; i++) {
      //let item = document.createElement("li");
      //item.innerHTML = files[i].webkitRelativePath;
      //output.appendChild(item);
    //};
  //}, false);

  //EVENT REFRESH PAGES
  //document.getElementById("refrehs").addEventListener("click", (  ) =>{
    //location.reload();
  //});


  //SEND DATA POST > METHOD POST ( search.php ) 
  const sendData = ( text ) =>{
    return new Promise( ( resolve, reject ) =>{

      try{

        //let send = [];
        //for(let i=0; i < files.length; i++){
          //send.push( files[i].name );        //SOLO ME QUEDO CON LOS NOMBRE DE ARCHIVO
        //}

        $.ajax({
          type: "POST",
          dataType: 'text',
          url: '../php/search.php',
          data: { 'text' : text } ,
          beforeSend : ()=>{ $('#myModal').modal('show'); },
          success: ( result ) =>{
            setTimeout(function() { 
              $('#myModal').modal('hide');
            }, 3000);
            resolve ( JSON.parse( result) );
          },
          error : ( ems, message ) =>{
            reject( 'ERROR IN REQUEST.' );
          }
        });

      }catch( err ){
        reject( 'ERROR IN DATA POST.' );
      }
 
    });
  }

  //VIEW RESULT
  const viewResult = ( results = null ) =>{

    if( results ){
      let resultSplit = results.toString().split(',');

      if( resultSplit.length > 0 ){

        let data = '<ul>';
        resultSplit.forEach( element => {
          data += `
            <li> ${element} </li>
          `;
        });
        data += '</ul>'
        
        document.getElementById("result").innerHTML = data;   

      }else{
        document.getElementById("result").innerHTML = resultSplit;   
      }

    }else{
      document.getElementById("result").innerHTML = "";
    }
  }

});
