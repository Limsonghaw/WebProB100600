
// set the variable using ID
var select = document.getElementById("dptID");
var dptNameSpan = document.getElementById("dptName");
var positionSelect = document.getElementById("position");



select.addEventListener("change", function() {
  // get the option value 
  var selectedOptionValue = select.value;
  // set the position value is null
  positionSelect.innerHTML = "";
  // put the value into the span 
  dptNameSpan.textContent = selectedOptionValue;

  
  if (selectedOptionValue === "IT") {
    // when only choose the IT department will shown below list
    //change the content where id= position
    positionSelect.innerHTML = ` 
      <option value="">Choose your position</option>
      <option value="Computer systems manager">Computer systems manager</option>
      <option value="Network architect">Network architect</option>
      <option value="Systems analyst">Systems analyst</option>
      <option value="IT coordinator">IT coordinator</option>
    `;
  } else if (selectedOptionValue === "Accounting") {
    // when only choose the Accounting department will shown below list
    //change the content where id= position
    positionSelect.innerHTML = `
    <option value="">Choose your position</option>
    <option value="Bookkeepers">Bookkeepers</option>
    <option value="Junior Accountants">Junior Accountants</option>
    <option value="Staff Accountants">Staff Accountants</option>
    <option value="Senior Accountants,">Senior Accountants</option>
    `;
  } else if (selectedOptionValue === "Marketing") {
    // when only choose the Marketing department will shown below list
    //change the content where id= position
    positionSelect.innerHTML = `
    <option value="">Choose your position</option>
    <option value="Chief Marketing Officer">Chief Marketing Officer</option>
    <option value="Director of Marketing">Director of Marketing</option>
    <option value="Marketing Analyst">Marketing Analyst</option>
    <option value="Marketing Coordinator">Marketing Coordinator</option>
    `;
  }else if (selectedOptionValue === "Finance") {
    // when only choose the Finance department will shown below list
    //change the content where id= position
    positionSelect.innerHTML = `
    <option value="">Choose your position</option>
    <option value="Finance Clerk"> Finance Clerk</option>
    <option value="Financial Advisor Assistant"> Financial Advisor Assistant</option>
    <option value="Purchasing Clerk"> Purchasing Clerk</option>
    <option value="Finance Intern"> Finance Intern</option>
    `;
  }
});

