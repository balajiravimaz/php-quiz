const user=document.getElementById("user");
const input=document.querySelector(".inp-group");

function removeInput(){
  this.parentElement.remove();
}

function addInput(){  
  let no=parseInt(this.value);
  const fall=document.querySelectorAll(".flex");
  fall.forEach((list) => {
    //   console.log(fall.length);
    const allinp =list.querySelectorAll("input");
    allinp.forEach((items) => {
        if(items.value == ""){
            items.parentElement.remove();
        }
    })
  })
//   if(fall.length > 0){
//     fall.forEach(e => e.remove());
//   }




  for(let i=1;i<=no;i++){

const lang = document.createElement("select");

lang.name="language[]";

const opt = ['Tamil','English','Telugu','Malayalam','Kanada','French','Hindhi','Spanish'];

opt.forEach((opts) => {
    const option = document.createElement("option");
    option.value = opts;
    option.text = opts;
    lang.append(option);
})



  const name = document.createElement("input");
  name.type="text";
  name.placeholder="proficiency Level";
  name.name="name[]";

 const email = document.createElement("input");
  email.type="text";
  email.placeholder="Proficiency Level";
  email.name="email[]";

 const email1 = document.createElement("input");
  email1.type="text";
  email1.placeholder="Proficiency Level";
  email1.name="email1[]";
  
  const btn=document.createElement("a");
  btn.className="delete";
  btn.innerHTML="&times";
  
  btn.addEventListener("click", removeInput);
  
  const flex=document.createElement("div");
  flex.className="flex flex" +i;
  
  input.appendChild(flex);
  flex.appendChild(lang);
  flex.appendChild(name);
  flex.appendChild(email);
  flex.appendChild(email1);
  flex.appendChild(btn); 
  }
  
}


user.addEventListener("change", addInput);