function writeHours(){
   let hours = document.getElementById("hour");
   let string = "";
    
        
    for(let i = 7; i < 24; i++){
        if(i < 10)
            string += "<option name='hour' value='0" + i + "'>" + 0 + i + "</option>"; 
        else
            string += "<option name='hour' value='" + i + "'>" +  i + "</option>"; 
    }
    
    
    hours.innerHTML = string;
}