/*
Author: Noah Jackson
Course: Web Programming
Assignment:JS Project
File purpose: Handles Portfolio repeated HTML and form validation
*/

"use strict";

//Adds navBar
document.getElementById("navBar").innerHTML = 
    `<ul class='navClass'>
        <li id ='name'><span style = 'color:aquamarine'>N</span>oah.</li>
        <li><a href = 'contact.html'>Contact</a></li>
        <li><a href = 'projects.html'>Projects</a></li>
        <li><a href = 'skills.html'>Skills</a></li>
        <li><a href = 'about.html'>About</a></li>
        <li><a href = 'home.html'>Home</a></li>
    </ul>`;

function validateForm() {

  //Gets text input values
  let firstName = document.forms["contact"]["fname"].value;
  let lastName = document.forms["contact"]["lname"].value;
  let email = document.forms["contact"]["email"].value;
  let phone = document.forms["contact"]["phone"].value;

  //saves input values to an array
  let textInputs = [firstName, lastName, email, phone];

  //creates and array of elements used in specific alerts
  let inputNames = ["First name", "Last name", "Email", "Phone"]

  //validates that the text fields are not empty
  let l = textInputs.length;
  for(let i = 0; i < l; i++) {
    if (textInputs[i] == "") {
      alert(`${inputNames[i]} must be filled out`);
      return false;
    }
  }

  //Regular expression for checking digits
  let digit = /\d/;

  //Validates that the first and last names have no digits
  for(let i = 0; i < 2; i++) {
    if (digit.test(textInputs[i])) {
      alert(`${inputNames[i]} can not contain a number`);
      return false;
    }
  }

  //Regular expression for checking numeric inputs
  let onlyDigits = /^\d+$/;

  //Validates that the phone number has only numbers
  if (!onlyDigits.test(textInputs[3])) {
    alert(`${inputNames[3]} can only contain numbers`);
    return false;
  }

  //Input validation for radio buttons
  let recruiter = document.forms["contact"]["radio"].value;
  if(recruiter == "") {
    alert(`Please select if you are a recruiter`);
    return false; 
  }
  return true;
}
  