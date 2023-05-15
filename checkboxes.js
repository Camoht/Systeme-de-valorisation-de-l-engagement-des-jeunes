function countCheck(checkbox) { //Count the number of checked
    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  
    if (checkboxes.length > 4) {
      checkbox.checked = false;
      alert("Uniquement 4 choix.");
    }
  }