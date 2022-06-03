<div class="row justify-content-center mt-4">
<div class="card col-5 me-3 h-auto">
    <div class="card-body">
    <h5 class="card-title">Jelenlegi állás:</h5>
    <p class="card-text">Jelenleg nyitott projektek: <?php $project->OpenProject($db) ?></p>
    <p class="card-text">Lezárt projektek: <?php $project->ClosedProjects($db)?></p>
    <p class="card-text">Legközelebbi leadási dátum: <?php echo $project->NearestProject($db)['planned_end'] ?></p>
    <a href=<?php echo('index.php?module=projects&id=' . $project->NearestProject($db)['id'] . '&action=view')?>  class="btn btn-primary">Irány a projekthez!</a>
  </div>
</div>
<div class="card col-5 ms-3 h-auto align-text-center">
  <div class="card-body ">
     <h5>Ha túl szürke a nap: </h5>
    <p class="card-text mt-3"><?php GetDaJoke()?></p>
  </div>
</div>
</div>

