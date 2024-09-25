<?php
$dataUser = unserialize($_SESSION['dataUser']);
$musicArray = isset($_SESSION['dataMusic']) ? unserialize($_SESSION['dataMusic']) : [];
?>


<link rel="stylesheet" href="assets/css/profile.css">
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>



<div class="profile-container">
  <div class="col-md-4">
    <div class="card profile-card-2">
      <div class="card-img-block">
        <img class="img-fluid" src="https://images.unsplash.com/photo-1422393462206-207b0fbd8d6b?dpr=1&auto=format&crop=entropy&fit=crop&w=1500&h=1000&q=80" alt="Card image">
      </div>
      <div class="card-body pt-5">
        <img src="https://www.rbsdirect.com.br/filestore/9/6/6/3/4/9/4_964fd9a444fb672/4943669_63bca88572cb332.jpg?format=webp&h=392&w=392" alt="profile-image" class="profile" />
        <h5 class="card-title"><?php echo $dataUser->getLogin() ?></h5>
        <p class="card-text">Melhor Presidente do Mundo</p>
      </div>
    </div>
  </div>
  <div class="profile-body">
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
    <p class="text-profile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque laboriosam culpa eum quo corrupti similique, nam voluptatum repellat quaerat ipsum totam tempora repudiandae! Ad illum similique corrupti? Nemo, excepturi!</p>
  </div>
</div>
</div>