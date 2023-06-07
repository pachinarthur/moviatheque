document.addEventListener('DOMContentLoaded', () => {
    var carousel = new bootstrap.Carousel(document.querySelector('#last-movies-carousel'));


    document.querySelectorAll('.movie-details').forEach((button) => {
        button.addEventListener('click', () => {
            let id = button.dataset.id;
            fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=1f54bd990f1cdfb230adb312546d765d`)
                .then(response => response.json())
                .then(movie => {
                    document.querySelector('#movie-details-modal .modal-title').innerHTML = movie.title;
                    document.querySelector('#movie-details-modal .modal-body').innerHTML = `
                        <div class="row">
                            <div class="col-md-4">
                                <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <p><strong>Overview:</strong> ${movie.overview}</p>
                                <p><strong>Release date:</strong> ${movie.release_date}</p>
                                <p><strong>Genres:</strong> ${movie.genres.map(genre => genre.name).join(', ')}</p>
                                <p class="mb-0"><strong>Runtime:</strong> ${movie.runtime} minutes</p>
                            </div>
                        </div>
                    `;
                }).then(() => {
                $('#movie-details-modal').modal('show');
            });
        });
    });
});