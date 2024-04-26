/*
Author: Noah Jackson
Course: Web Programming
Assignment:JS Project
File purpose: holds functions for the todo.html
*/

"use strict";

function createList() {
  // Get the name of the new list
  let ListInput = document.getElementById("listName")
  let listID = ListInput.value;

  //----------------Error Handling----------------------------

  // Hides error message 
  let errorMessage = document.getElementById("error");
  errorMessage.hidden = true;

  // If no name is entered, an error message will appear
  if (listID == "") {
    errorMessage.innerHTML = "ERROR: A new list must have name";
    errorMessage.hidden = false;
    return
  }

  //-------------Creating new list and list items------------
    
  // Create a new list element
  let ul = document.createElement("ul");
  ul.setAttribute("key", listID);
  ul.setAttribute("id", listID);
  ul.textContent = "List: " + listID + " | ";

  // Create a new button element for creating a li
  let newItem = document.createElement("button");
  newItem.textContent = "New Item";
  newItem.onclick = function() {
    createItem(listID);
  };

  //------------Create a new select element-----------------
  let colorSelect = document.createElement("select");

  // Add options to the select element
  let options = ["Black", "Blue", "Red"];
  options.forEach(optionText => {
    let option = document.createElement("option");
    option.text = option.value = optionText;
    colorSelect.add(option);
  });

  // When the option selected changes, the color will update
  colorSelect.onchange = function() {
    ul.style.color = colorSelect.value;
  };

  //--------Adding created elements to HTML Page-----------

  // Append the button to the list
  ul.appendChild(newItem);
  ul.appendChild(colorSelect);

  // Append the list to the body
  document.body.appendChild(ul);
    
  // Resets the input field for list name
  ListInput.value = "";
}

// Adds a new list item to provided ul ID
function createItem(listID) {
  let list = document.getElementById(listID);
  let newItem = document.createElement("li");
  newItem.innerHTML = `<input type="text" size="15">`;
  list.appendChild(newItem); 
}

// Reload the current page
function refreshPage() {
  location.reload();
}

// Creates a live clock on 
setInterval(myTimer, 1000);

function myTimer() {
  const d = new Date();
  document.getElementById("clock").innerHTML = d.toLocaleTimeString();
}

function backToLastPage() {
  window.history.back()
}