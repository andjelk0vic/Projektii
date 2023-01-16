function validateName(name){
    if(name === ""){
      return false;
    }
  
    return true;
  }
  
  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }
  
  function validatePhone(phone){
    if(phone === ""){
      return false;
    }
  
    return true;
  }
  
  function validateSubject(subject){
    if(subject === ""){
      return false;
    }
  
    return true;
  }
  
  function validateMessage(message){
    if(message === ""){
      return false;
    }
    
    return true;
  }
  
  function validateMessageLength(message){
    if(message.length < 10){
      return false;
    }
    
    return true;
  }
  
  /* **** VALIDATE FORM ON SUBMIT **** */
  
  function validateForm(event) {
    
      let name = document.querySelector("#name").value;
      let email = document.querySelector("#email").value;
      let phone = document.querySelector("#phone").value;
      let subject = document.querySelector("#subject").value;
      let message = document.querySelector("#message").value;
      let radios = document.getElementsByName('gender');
  
      if(!validateName(name)){
        alert("Please enter name.");
  
        return false;
      }
  
  
      if(!validateEmail(email)){
        alert("Please enter valid email.");
  
        return false;
      }
  
      if(!validatePhone(phone)){
        alert("Please enter phone number.");
  
        return false;
      }
  
      if(!validateSubject(subject)){
        alert("Please enter subject.");
  
        return false;
      }
  
      if(!validateMessage(message)){
        alert("Please enter message.");
  
        return false;
      }
  
      if(!validateMessageLength(message)){
        alert("Message needs to containt at least 10 characters.");
  
        return false;
      }

      let gender;

      for (let i = 0, length = radios.length; i < length; i++){
        if (radios[i].checked){
          gender = radios[i].value;
  
          break;
        }
      }

      if(gender == undefined){
        gender = "Left empty.";
      }   
      
      alert("Uneti podaci: \n" + name + "\n" + phone + "\n" + email + "\n" + subject + "\n" + message + "\nUSPESNO POSLATO!");

  
      return true;
  }