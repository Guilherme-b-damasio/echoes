<?php
$dataUser = unserialize($_SESSION['dataUser']);
$musicArray = isset($_SESSION['dataMusic']) ? unserialize($_SESSION['dataMusic']) : [];
?>


<link rel="stylesheet" href="assets/css/profile.css">
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<div class="main-container" id="main-container"></div>
<div class="container emp-profile">
  <form method="post">
    <div class="row">
      <div class="col-md-4">
        <div class="profile-img">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHR59P3pBQCippxMawDmw2ZEpnn8MBOhQJ7A&s" alt="" />
          <div class="file btn btn-lg btn-primary">
            Change Photo
            <input type="file" name="file"/>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="profile-head">
          <h5>
            Kshiti Ghelani
          </h5>
          <h6>
            Web Developer and Designer
          </h6>
          <p class="proile-rating">RANKINGS : <span>8/10</span></p>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" />
      </div>

<div class="profile-container">
  <div class="card profile-card-2">
    <div id="card-img-block" class="card-img-block">
    </div>
    <div class="card-body pt-5">
      <img src="../src/uploads/<?php echo $dataUser->getId();?>/profile.png" alt="profile-image" id="profile" class="profile">
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
