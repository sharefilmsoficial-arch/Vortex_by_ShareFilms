document.addEventListener("DOMContentLoaded", () => {

    // Filtrar películas que tengan el género "Comedia"
    const comedyMovies = MOVIES.filter(movie =>
        movie.genres && movie.genres.some(
            g => g.toLowerCase() === "comedia" || g.toLowerCase() === "comedy"
        )
    );

    const container = document.getElementById("comedy-gallery");
    container.innerHTML = "";

    comedyMovies.forEach(movie => {
        const link = document.createElement("a");
        link.className = "card-link";
        link.href = `movie.html?id=${movie.id}`;

        const card = document.createElement("div");
        card.className = "card";
        card.style.backgroundImage = `url(${movie.image})`;

        const info = document.createElement("div");
        info.className = "card-info";
        info.innerHTML = `
            <h3>${movie.title}</h3>
            <p>${movie.year}</p>
        `;

        card.appendChild(info);
        link.appendChild(card);
        container.appendChild(link);
    });
});