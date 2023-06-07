<div class="col-3 mb-4 p-3">
    <div class="card h-100 d-flex flex-column grow shadow-sm">
        <img src="https://image.tmdb.org/t/p/w500/<?= $movie->poster_path; ?>"
             class="card-img-top"
             alt="..."
             onerror="this.onerror=null; this.src='assets/images/not-found.jpg';">
        <div class="card-body d-flex flex-column justify-content-between">
            <div>
                <div class="text-center">
                    <p class="card-text"><b>Date de sortie :</b> <?= $movie->release_date; ?></p>
                </div>
                <p class="card-text overview mb-3"><b>Synopsis : </b><?= $movie->overview; ?></p>

            </div>
            <div class="text-end">
                <button type="button" data-id="<?= $movie->id ?> "
                        class="movie-details btn btn-sm btn-dark"><i
                            class="fas fa-info-circle"></i>
                    Détails
                </button>
            </div>
        </div>
    </div>
</div>