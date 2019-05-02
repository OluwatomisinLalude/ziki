window.onload = function() {
  // disable default behavior for forms (reload once a buttun is clicked)
  const form = document.querySelector("#installForm");
  form.addEventListener("submit", function(event) {
    event.preventDefault();
  });
  // handle form switching
  const $ = document.querySelector.bind(document)
  let steps = document.getElementsByClassName("step-form");
  let stepOneForm = steps[0];
  let stepTwoForm = steps[1];
  $('#installButton').addEventListener("click", function(){
    let fname = $('#firstname').value;
    let lname = $('#lastname').value;
    let uname = $('#username').value;
    let mail = $('.e-mail').value;
    let dnn = $('.domain-name').value;
    let dn = $('.domain').value;
    let tag = $('.tag').value;
    let country = $('.country').value;

    fetch('/publish', {
      method: 'POST',
      body: JSON.stringify({firstname:fname, lastname:lname, username:uname, email:mail, url:`${dnn+dn}`, bio:tag, country:country})
    })
    .then((res) => { console.log(res) })
    .catch((err)=>console.log(err))
  });
  document.getElementById("nextButton").addEventListener("click", function() {
    // stepOneForm.classList.add("animated", "fadeOutLeft");
    stepOneForm.style.display = "none";
    stepTwoForm.style.display = "initial";
    // stepTwoForm.classList.add("animated", "fadeInRight");
  });
  document
    .getElementById("previousButton")
    .addEventListener("click", function() {
      stepTwoForm.style.display = "none";
      stepOneForm.style.display = "initial";
    });

  // make sure accept terms and conditions is checked before enabling install button
  document.querySelector("#acceptTerms").addEventListener("change", function() {
    document.getElementById("installButton").toggleAttribute("disabled");
  });
};
