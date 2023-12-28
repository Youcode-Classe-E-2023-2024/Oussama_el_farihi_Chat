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


//pop up form
document.addEventListener("DOMContentLoaded", function() {
  var modal = document.getElementById("addGroupChatModal");
  var addButton = document.querySelector(".add");
  var closeButton = document.querySelector(".close-button");


  modal.style.display = "none";

  addButton.addEventListener("click", function() {
      modal.style.display = "flex";  
  });

  closeButton.addEventListener("click", function() {
      modal.style.display = "none"; 
  });
});



//sending message useing ajax
document.getElementById('sendButton').addEventListener('click', function() {
  var userId = document.getElementById('userIdInput').value;
  var roomId = document.getElementById('roomIdInput').value;
  var message = document.getElementById('messageInput').value;

  $.ajax({
      url: 'index.php?page=home1', // Update with the actual path
      type: 'POST',
      data: {
          user_id: userId,
          room_id: roomId,
          messageInput: message
      },
      success: function(response) {
          document.getElementById('messageInput').value = '';
      },
      error: function() {
          console.log('Error sending message');
      }
  });
});


//getting message using ajax
$('.msg.online').click(function(event) {
  event.preventDefault();
  var roomId = $(this).attr('href').split('=')[1];

  $.ajax({
      url: 'index.php?page=home1' + roomId,
      type: 'GET',
      dataType: 'json',
      success: function(messages) {
          // Handle the fetched messages, e.g., append them to the chat area
          var chatArea = $('#chat-section');
          chatArea.empty(); // Clear previous messages
          messages.forEach(function(message) {
              var messageClass = message.id_user == userId ? 'owner' : '';
              var messageHtml = '<div class="chat-msg ' + messageClass + '"><span>' + message.contenu + '</span></div>';
              chatArea.append(messageHtml);
          });
      },
      error: function() {
          console.log('Error fetching messages');
      }
  });
});