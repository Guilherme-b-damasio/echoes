<?php
$dataUser = unserialize($_SESSION['dataUser']);
$musicArray = isset($_SESSION['dataMusic']) ? unserialize($_SESSION['dataMusic']) : [];
?>


<link rel="stylesheet" href="assets/css/profile.css">
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<div class="main-container" id="main-container"></div>
<div class="profile-container">
  <div class="card profile-card-2">
    <div id="card-img-block" class="card-img-block">
    </div>
    <div class="card-body pt-5">
      <img src="../src/uploads/<?php echo $dataUser->getId(); ?>/profile.png" alt="profile-image" id="profile" class="profile">
      <div id="profile-hover" class="profile-hover"><i class="fa-solid fa-pen-to-square"></i>
        <p class="text-photo">Alterar foto</p>
      </div>
      <div class="profile-text">
        <h5 class="card-title"><?php echo $dataUser->getLogin() ?></h5>
        <p class="card-text">Melhor Presidente do Mundo</p>
      </div>
    </div>
  </div>
  <div class="profile-body">
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="profile-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
  </div>
</div>
</div>

<script defer src="js/profile.js"></script>