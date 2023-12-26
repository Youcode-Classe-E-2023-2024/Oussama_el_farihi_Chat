const toggleButton = document.querySelector('.dark-light');
const colors = document.querySelectorAll('.color');
console.log('test');
colors.forEach(color => {
  color.addEventListener('click', e => {
    colors.forEach(c => c.classList.remove('selected'));
    const theme = color.getAttribute('data-color');
    document.body.setAttribute('data-theme', theme);
    color.classList.add('selected');
  });
});

toggleButton.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
});


//pop form
document.addEventListener("DOMContentLoaded", function() {
  var modal = document.getElementById("addGroupChatModal");
  var addButton = document.querySelector(".add");
  var closeButton = document.querySelector(".close-button");

 
  function toggleModal() {
    if (modal.style.display === "flex") {
      modal.style.display = "none";
    } else {
      modal.style.display = "flex";
    }
  }

  
  addButton.addEventListener("click", function(event) {
    event.stopPropagation(); 
    toggleModal();
  });


  closeButton.addEventListener("click", function(event) {
    event.stopPropagation(); 
    toggleModal();
  });


  window.addEventListener("click", function(event) {
    if (event.target === modal) {
      toggleModal();
    }
  });
});
