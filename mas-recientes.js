document.addEventListener("DOMContentLoaded", () => {

    const currentYear = new Date().getFullYear();
    const recentMovies = MOVIES.filter(
        movie => movie.year >= currentYear - 5 && movie.year <= currentYear
    );

    const container = document.getElementById("recent-gallery");
    container.innerHTML = "";

    recentMovies.forEach(movie => {
        const link = document.createElement("a");
        link.className = "card-link";
        link.href = `movie.html?id=${movie.id}`;

        const card = document.createElement("div");
        card.className = "card";
        card.style.backgroundImage = `url(${movie.image})`;

        const info = document.createElement("div");
        info.className = "card-info";
        info.innerHTML = `<h3>${movie.title}</h3><p>${movie.year}</p>`;

        card.appendChild(info);
        link.appendChild(card);

        container.appendChild(link);
    });
});