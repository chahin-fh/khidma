function verif(){
    let TDJ = document.getElementById("TDJ").value;
    let S = document.getElementById("S").value;
    let m = document.getElementById("m").value;
    let T = document.getElementById("T").value;
    let SDC = document.getElementById("SDC").value;
    let date = document.getElementById("date").value;
    let SLT = document.getElementById("SLT").value;
    let autre = document.getElementById("autre").value;
    if(TDJ === "0" || TDJ === "" || TDJ==="e"){
        document.getElementById("er1").innerHTML = "nssit il travail du jour"
        document.getElementById("er2").innerHTML = ""
        document.getElementById("er3").innerHTML = ""
        document.getElementById("er4").innerHTML = ""
        document.getElementById("er5").innerHTML = ""
        document.getElementById("er6").innerHTML = ""
        document.getElementById("er7").innerHTML = ""
        return false
    }else if( S === "" || S==="e"){
        document.getElementById("er2").innerHTML = "nssit il sel3a"
        document.getElementById("er1").innerHTML = ""
        document.getElementById("er3").innerHTML = ""
        document.getElementById("er4").innerHTML = ""
        document.getElementById("er5").innerHTML = ""
        document.getElementById("er6").innerHTML = ""
        document.getElementById("er7").innerHTML = ""
        return false
    }else if( m === "" ||m ==="e"){
        document.getElementById("er3").innerHTML = "nssit il mazout"
        document.getElementById("er2").innerHTML = ""
        document.getElementById("er1").innerHTML = ""
        document.getElementById("er4").innerHTML = ""
        document.getElementById("er5").innerHTML = ""
        document.getElementById("er6").innerHTML = ""
        document.getElementById("er7").innerHTML = ""
        return false
    }else if( T === "" || T==="e"){
        document.getElementById("er4").innerHTML = "nssit il taslih"
        document.getElementById("er2").innerHTML = ""
        document.getElementById("er3").innerHTML = ""
        document.getElementById("er1").innerHTML = ""
        document.getElementById("er5").innerHTML = ""
        document.getElementById("er6").innerHTML = ""
        document.getElementById("er7").innerHTML = ""
        return false
    }else if(SDC === "" || SDC==="e"){
        document.getElementById("er5").innerHTML = "nssit il salaire du chouffeur"
        document.getElementById("er2").innerHTML = ""
        document.getElementById("er3").innerHTML = ""
        document.getElementById("er4").innerHTML = ""
        document.getElementById("er1").innerHTML = ""
        document.getElementById("er6").innerHTML = ""
        document.getElementById("er7").innerHTML = ""
        return false
    }else if(date === ""){
        document.getElementById("er6").innerHTML = "nssit il date"        
        document.getElementById("er2").innerHTML = ""
        document.getElementById("er3").innerHTML = ""
        document.getElementById("er4").innerHTML = ""
        document.getElementById("er5").innerHTML = ""
        document.getElementById("er1").innerHTML = ""
        document.getElementById("er7").innerHTML = ""
        return false
    }else if(SLT === ""){
        document.getElementById("er7").innerHTML = "nssit bich ti5tar vehicle"
        document.getElementById("er2").innerHTML = ""
        document.getElementById("er3").innerHTML = ""
        document.getElementById("er4").innerHTML = ""
        document.getElementById("er5").innerHTML = ""
        document.getElementById("er6").innerHTML = ""
        document.getElementById("er1").innerHTML = ""
        return false
    }else{
        document.getElementById("mrgl").innerHTML = "jwk behi"
        document.getElementById("er7").innerHTML = ""
        document.getElementById("er2").innerHTML = ""
        document.getElementById("er3").innerHTML = ""
        document.getElementById("er4").innerHTML = ""
        document.getElementById("er5").innerHTML = ""
        document.getElementById("er6").innerHTML = ""
        document.getElementById("er1").innerHTML = ""
    }
}