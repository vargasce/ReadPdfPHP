$( document ).ready(function() {


  $('#enventSearch').on('click', async ( event )=>{

    event.preventDefault();
    let text = document.getElementById("text").value;
    let filesSend = document.getElementById("filepicker").files ;
    
    try{
      let result = await sendData( text, filesSend );
      console.log( result );
    }catch( err ){
      console.error( err );
    }

  });


  //EVENT LOAD FILE
  document.getElementById("filepicker").addEventListener("change", function(event) {
    let output = document.getElementById("listing");
    let files = event.target.files;

    for (let i=0; i<files.length; i++) {
      let item = document.createElement("li");
      item.innerHTML = files[i].webkitRelativePath;
      output.appendChild(item);
    };
  }, false);

  //EVENT REFRESH PAGES
  document.getElementById("refrehs").addEventListener("click", ( event ) =>{
    location.reload();
  });


  //SEND DATA POST 
  const sendData = ( text, files ) =>{
    return new Promise( ( resolve, reject ) =>{

      try{

        let send = [];
        for(let i=0; i < files.length; i++){
          send.push( files[i].name )
        }

        let sendPacket = JSON.stringify( send );

        $.ajax({
          type: "POST",
          dataType: 'text',
          url: '../php/search.php',
          data: { 'text' : text , 'files' :  send  } ,
          beforeSend : ()=>{ $('#myModal').modal('show'); },
          success: ( result ) =>{
            setTimeout(function() { 
              $('#myModal').modal('hide');
            }, 3000);
            resolve ( result );
          },
          error : ( ems, message ) =>{
            reject( 'Error en la solicitud.' );
          }
        });

      }catch( err ){
        reject( 'Error al enviar datos.' );
      }
 
    });
  }

});
