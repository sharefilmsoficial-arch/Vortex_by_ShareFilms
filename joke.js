// movies.js — versión corregida compatible con index.html

const sampleTrailer = "https://www.w3schools.com/html/mov_bbb.mp4"; // Tráiler genérico temporal

const MOVIES = [
  {
    id: "the-karate-kid-2",
    title: "El Karate Kid 2",
    year: 2018,
    duration: "1h 56min",
    rating: "PG",
    genres: ["Animación", "Aventura"],
    description: "Miles Morales se convierte en Spider-Man y conoce a otros héroes arácnidos de universos paralelos.",
    trailerUrl: sampleTrailer,
    image: "jokes/the-karate-kid-2.jpg",
    movie: "https://drive.google.com/file/d/1Gp-v1xvRausPDh9c88yxOSFusXM9dkwE/preview"
  },
  {
    id: "incredibulls-3",
    title: "Los Incredibulls 3",
    year: 2023,
    duration: "2h 20min 05s",
    rating: "PG",
    genres: ["Animación", "Acción", "Aventura", "Superhéroes"],
    description: "Luego de ser mordido por una araña radioactiva, Miles Morales desarrolla misteriosos poderes que lo transforman en el Hombre Araña. Ahora deberá usar sus nuevas habilidades ante el malvado Kingpin, un enorme demente que puede abrir portales hacia otros universos.",
    image: "jokes/incredibulls-3.jpg",
    trailerUrl: "trailers/across-the-spiderverse.mp4",
    movie: "https://drive.google.com/file/d/11SMv4hmFUM71MWcPYm5qXf5j-tJgeAWp/preview"
  },
  {
    id: "fast_and_the_fragile_the_final_lap",
    title: "Rapidos y Frágiles - La Vuleta Final",
    year: 2023,
    duration: "2h 20min 05s",
    rating: "PG",
    genres: ["Animación", "Acción", "Aventura", "Superhéroes"],
    description: "Luego de ser mordido por una araña radioactiva, Miles Morales desarrolla misteriosos poderes que lo transforman en el Hombre Araña. Ahora deberá usar sus nuevas habilidades ante el malvado Kingpin, un enorme demente que puede abrir portales hacia otros universos.",
    image: "jokes/fast_and_the_fragile_the_final_lap.jpg",
    trailerUrl: "trailers/across-the-spiderverse.mp4",
    movie: "https://drive.google.com/file/d/11SMv4hmFUM71MWcPYm5qXf5j-tJgeAWp/preview"
  }
];

// (Opcional) Exponerlo globalmente
window.MOVIES = MOVIES;