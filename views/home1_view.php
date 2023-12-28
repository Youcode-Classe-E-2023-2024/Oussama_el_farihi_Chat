<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Chat</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
<!-- partial:index.partial.html -->
<div class="app">
 <div class="header">
  <div class="logo">
   <svg viewBox="0 0 513 513" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path d="M256.025.05C117.67-2.678 3.184 107.038.025 245.383a240.703 240.703 0 0085.333 182.613v73.387c0 5.891 4.776 10.667 10.667 10.667a10.67 10.67 0 005.653-1.621l59.456-37.141a264.142 264.142 0 0094.891 17.429c138.355 2.728 252.841-106.988 256-245.333C508.866 107.038 394.38-2.678 256.025.05z" />
    <path d="M330.518 131.099l-213.825 130.08c-7.387 4.494-5.74 15.711 2.656 17.97l72.009 19.374a9.88 9.88 0 007.703-1.094l32.882-20.003-10.113 37.136a9.88 9.88 0 001.083 7.704l38.561 63.826c4.488 7.427 15.726 5.936 18.003-2.425l65.764-241.49c2.337-8.582-7.092-15.72-14.723-11.078zM266.44 356.177l-24.415-40.411 15.544-57.074c2.336-8.581-7.093-15.719-14.723-11.078l-50.536 30.744-45.592-12.266L319.616 160.91 266.44 356.177z" fill="#fff" /></svg>
  </div>
  <div class="search-bar">
   <input type="text" placeholder="Search..." />
  </div>
  <div class="user-settings">
   <div class="dark-light">
    <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
     <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" /></svg>
   </div>
   <div class="settings">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
     <circle cx="12" cy="12" r="3" />
     <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" /></svg>
   </div>
   <img class="user-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" class="account-profile" alt="">
  </div>
  <form action="index.php?page=home1" method="post">
  <button type="submit" name="logout">log out</button>
  </form>
 </div>
 <div class="wrapper">
  <div class="conversation-area">
   <div class="msg active">
    
    <div class="msg-detail">
     
    </div>
   </div>
   <!-------dynamic group fetched-------->
   <div class="conversation-area">
    <?php foreach ($rooms as $room): 
        $rooms_id = $room['id_room'];
        $rooms_picture = $room['img'];
        $rooms_title = $room['name_room'];
    ?>
        <a href="index.php?page=home1&room=<?php echo $rooms_id; ?>" class="msg online">
        <img class="msg-profile" src="./assets/img/<?php echo htmlspecialchars($rooms_picture); ?>" alt="" />
        <div class="msg-detail">
            <div class="msg-username"><?php echo htmlspecialchars($rooms_title); ?></div>
        </div>
    </a>
    <?php endforeach; ?>
</div>
<!-------dynamic group fetched-------->
   <button class="add"></button>
   <div class="overlay"></div>
  </div>
  <!------chat section-------->
  <div class="chat-area">
   <div class="chat-area-header">
    <div class="chat-area-title">CodePen Group</div>
   </div>
   <!--------fetch message----->
   <div class="chat-area-main" id="chat-section">
    <?php 
    if(isset($_GET['room'])) {
        $roomId = $_GET['room'];
        $messages = Message::getMessagesByRoom($roomId);
        
        foreach ($messages as $message): ?>
            <div class="chat-msg <?= $message['id_user'] == $_SESSION['user_id'] ? 'owner' : '' ?>">
                <span><?= htmlspecialchars($message['contenu']) ?></span>
            </div>
        <?php endforeach; 
    }
    ?>
</div>
<!--------fetch message end----->
 <!-- Footer area for sending messages -->
 <div class="chat-area-footer">
      <!-- Form for sending messages -->
      <?php
      // echo "<pre>";
      // print_r($_SESSION);
      // echo "</pre>";?>
      <!-- <form id="sendMessageForm" action="index.php?page=home1" method="post">
      <input type="hidden" name="user_id" id="userIdInput" value="<?php echo $_SESSION["user_id"]; ?>">
      <input type="hidden" name="room_id" id="roomIdInput" value="<?php echo $roomId; ?>">
        <input type="text" id="messageInput" name="messageInput" placeholder="Type something here...">
        <button type="submit" name="submitM" class="send-message-btn">Send</button>
      </form>  -->
      <form id="sendMessageForm" method="post">
    <input type="hidden" name="user_id" id="userIdInput" value="<?php echo $_SESSION["user_id"]; ?>">
    <input type="hidden" name="room_id" id="roomIdInput" value="<?php echo $roomId; ?>">
    <input type="text" id="messageInput" name="messageInput" placeholder="Type something here...">
    <button type="button" id="sendButton" class="send-message-btn">Send</button>
</form>

  </div>
  <!------end chat section-------->
   

<div class="chat-area-main">
<!-- Popup form -->
<div id="addGroupChatModal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <h2>Add Group Chat</h2>
    <form id="addGroupChatForm" method="post" action="index.php?page=home1" enctype="multipart/form-data">
    <input type="file" name="picture">
      <input name="name_room" type="text" placeholder="Group Chat Name" required>
<select name="users[]" multiple required>
    <?php foreach($users as $user): ?>
        <option value="<?= $user['id_user'] ?>"><?= htmlspecialchars($user['name']) ?></option>
    <?php endforeach; ?>
</select>
      <button name="submitF" type="submit" class="submit-btn">Create Group</button>
    </form>
  </div>
</div>
<!-- partial -->
  <script  src="../assets/js/script.js"></script>
</body>
</html>